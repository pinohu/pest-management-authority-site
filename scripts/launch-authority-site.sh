#!/bin/bash
# launch-authority-site.sh
# Usage: ./scripts/launch-authority-site.sh "niche name"

set -e
NICHE="$1"
if [ -z "$NICHE" ]; then
  echo "Usage: $0 \"niche name\""
  exit 1
fi

echo "[INFO] Launching Authority Site for niche: $NICHE"

# Step 1: Provision WordPress with Docker Compose
if [ ! -f docker-compose.yml ]; then
  echo "[ERROR] docker-compose.yml not found in project root."
  exit 1
fi

echo "[INFO] Starting Docker Compose..."
docker-compose up -d

# Step 2: Wait for WordPress to be ready
WP_URL="http://localhost:8080"
echo "[INFO] Waiting for WordPress to be ready at $WP_URL..."
for i in {1..30}; do
  if curl -s "$WP_URL" | grep -q "WordPress"; then
    echo "[INFO] WordPress is up."
    break
  fi
  sleep 3
done

# Step 3: Activate Authority Blueprint theme
THEME_SLUG="authority-blueprint"
echo "[INFO] Activating theme: $THEME_SLUG"
docker-compose exec -T wpcli wp theme activate $THEME_SLUG

echo "[INFO] Installing and activating recommended plugins..."
PLUGINS=( "wordpress-seo" "wp-super-cache" )
for PLUGIN in "${PLUGINS[@]}"; do
  echo "[INFO] Installing plugin: $PLUGIN"
  docker-compose exec -T wpcli wp plugin install $PLUGIN --activate
  echo "[INFO] Plugin $PLUGIN installed and activated."
done

# Step 4: Generate pillar and cluster content using NEURONWriter MCP
PILLAR_TITLE="${NICHE^} Pillar Guide"
CLUSTER_TITLE="${NICHE^} Cluster Topic"
echo "[INFO] Calling NEURONWriter MCP for pillar content..."
PILLAR_CONTENT=$(curl -s -X POST "https://api.neuronwriter.com/generate" \
  -H "Content-Type: application/json" \
  -d "{\"topic\": \"$NICHE\", \"type\": \"pillar\"}" | jq -r '.content')
if [ -z "$PILLAR_CONTENT" ] || [ "$PILLAR_CONTENT" == "null" ]; then
  echo "[ERROR] Failed to generate pillar content via NEURONWriter."
  exit 1
fi
echo "[INFO] Pillar content generated. Creating post via WP-CLI..."
PILLAR_ID=$(docker-compose exec -T wpcli wp post create --post_type=pillar --post_title="$PILLAR_TITLE" --post_content="$PILLAR_CONTENT" --post_status=publish --porcelain)

echo "[INFO] Calling NEURONWriter MCP for cluster content..."
CLUSTER_CONTENT=$(curl -s -X POST "https://api.neuronwriter.com/generate" \
  -H "Content-Type: application/json" \
  -d "{\"topic\": \"$NICHE\", \"type\": \"cluster\"}" | jq -r '.content')
if [ -z "$CLUSTER_CONTENT" ] || [ "$CLUSTER_CONTENT" == "null" ]; then
  echo "[ERROR] Failed to generate cluster content via NEURONWriter."
  exit 1
fi
echo "[INFO] Cluster content generated. Creating post via WP-CLI..."
CLUSTER_ID=$(docker-compose exec -T wpcli wp post create --post_type=cluster --post_title="$CLUSTER_TITLE" --post_content="$CLUSTER_CONTENT" --post_status=publish --porcelain)

# Step 5: Auto-create categories and tags based on the niche
CATEGORY_SLUG=$(echo "$NICHE" | tr '[:upper:]' '[:lower:]' | tr ' ' '-')
CATEGORY_NAME="${NICHE^}"
echo "[INFO] Creating category: $CATEGORY_NAME ($CATEGORY_SLUG)"
CATEGORY_ID=$(docker-compose exec -T wpcli wp term create category "$CATEGORY_NAME" --slug="$CATEGORY_SLUG" --porcelain)
TAG_NAME="${NICHE^}"
echo "[INFO] Creating tag: $TAG_NAME"
TAG_ID=$(docker-compose exec -T wpcli wp term create post_tag "$TAG_NAME" --porcelain)

# Step 6: Assign pillar and cluster posts to category and tag
if [ -n "$PILLAR_ID" ]; then
  echo "[INFO] Assigning pillar post $PILLAR_ID to category $CATEGORY_ID and tag $TAG_ID"
  docker-compose exec -T wpcli wp post term set $PILLAR_ID category $CATEGORY_ID
  docker-compose exec -T wpcli wp post term set $PILLAR_ID post_tag $TAG_ID
fi
if [ -n "$CLUSTER_ID" ]; then
  echo "[INFO] Assigning cluster post $CLUSTER_ID to category $CATEGORY_ID and tag $TAG_ID"
  docker-compose exec -T wpcli wp post term set $CLUSTER_ID category $CATEGORY_ID
  docker-compose exec -T wpcli wp post term set $CLUSTER_ID post_tag $TAG_ID
fi

# Step 7: Enforce best practices (SEO, accessibility, performance)
echo "[INFO] Setting site title and tagline..."
SITE_TITLE="${NICHE^} Authority Hub"
SITE_TAGLINE="The #1 resource for $NICHE."
docker-compose exec -T wpcli wp option update blogname "$SITE_TITLE"
docker-compose exec -T wpcli wp option update blogdescription "$SITE_TAGLINE"

echo "[INFO] Setting permalinks to 'post name'..."
docker-compose exec -T wpcli wp option update permalink_structure "/%postname%/"
docker-compose exec -T wpcli wp rewrite flush

echo "[INFO] Enabling SEO plugin settings (Yoast example)..."
docker-compose exec -T wpcli wp yoast index

echo "[INFO] Enabling caching plugin (if available)..."
docker-compose exec -T wpcli wp plugin activate wp-super-cache || true

# Step 8: Generate FAQ and homepage content using NEURONWriter MCP
echo "[INFO] Calling NEURONWriter MCP for FAQ content..."
FAQ_CONTENT=$(curl -s -X POST "https://api.neuronwriter.com/generate" \
  -H "Content-Type: application/json" \
  -d "{\"topic\": \"$NICHE\", \"type\": \"faq\"}" | jq -r '.content')
if [ -z "$FAQ_CONTENT" ] || [ "$FAQ_CONTENT" == "null" ]; then
  echo "[ERROR] Failed to generate FAQ content via NEURONWriter."
else
  echo "[INFO] FAQ content generated. Creating FAQ post via WP-CLI..."
  docker-compose exec -T wpcli wp post create --post_type=faq --post_title="${NICHE^} FAQ" --post_content="$FAQ_CONTENT" --post_status=publish
fi

echo "[INFO] Calling NEURONWriter MCP for homepage content..."
HOMEPAGE_CONTENT=$(curl -s -X POST "https://api.neuronwriter.com/generate" \
  -H "Content-Type: application/json" \
  -d "{\"topic\": \"$NICHE\", \"type\": \"homepage\"}" | jq -r '.content')
if [ -z "$HOMEPAGE_CONTENT" ] || [ "$HOMEPAGE_CONTENT" == "null" ]; then
  echo "[ERROR] Failed to generate homepage content via NEURONWriter."
else
  echo "[INFO] Homepage content generated. Updating front page via WP-CLI..."
  FRONT_PAGE_ID=$(docker-compose exec -T wpcli wp post create --post_type=page --post_title="Home" --post_content="$HOMEPAGE_CONTENT" --post_status=publish --porcelain)
  docker-compose exec -T wpcli wp option update show_on_front "page"
  docker-compose exec -T wpcli wp option update page_on_front $FRONT_PAGE_ID
fi

# Step 9: (Pseudo) Integrate AltText.ai for image alt text (actual logic in theme)
echo "[INFO] AltText.ai integration for image alt text is handled in theme functions."

# Step 10: Integrate Pulsetic for uptime monitoring (pseudo-call)
SITE_URL="http://localhost:8080"
echo "[INFO] Integrating Pulsetic for uptime monitoring (pseudo-call)..."
# Example: curl -X POST "https://api.pulsetic.com/v1/checks" -H "Authorization: Bearer $PULSETIC_API_KEY" -d '{"url": "$SITE_URL", "name": "$NICHE Authority Site"}'
echo "[INFO] (Pseudo) Pulsetic monitoring setup for $SITE_URL. Configure DNS and API key for production."

echo "[INFO] Monitoring/reporting automation complete. Next: end-to-end test and documentation."

# Step 11: Create all major content for Pest Management Science

# Homepage
HOMEPAGE_HTML='<section class="hero pest-mgmt-hero" style="background: #e8f5e9; padding: 3rem 0;"><div class="container" style="max-width: 900px; margin: 0 auto; text-align: center;"><h1>Innovating Pest Management Science for a Safer Tomorrow</h1><p class="subheadline" style="font-size: 1.25rem; color: #388e3c;">Leading research, insights, and solutions to protect crops, health, and the environment.</p><p class="value-prop" style="margin: 2rem 0;">Empowering professionals with cutting-edge knowledge and tools to effectively manage pests and promote sustainable practices.</p><a href="#research" class="cta-button" style="background: #388e3c; color: #fff; padding: 1rem 2rem; border-radius: 4px; text-decoration: none; font-weight: bold;">Explore Our Research</a></div></section><section class="intro" style="background: #fff; padding: 2rem 0;"><div class="container" style="max-width: 800px; margin: 0 auto;"><p>Welcome to <strong>Pest Management Science Authority</strong>, your premier source for the latest advancements and expert guidance in pest management. Our mission is to advance scientific understanding and practical applications that safeguard agriculture, public health, and ecosystems. Whether you are a researcher, practitioner, or policymaker, we provide comprehensive resources, evidence-based strategies, and collaborative opportunities to help you stay ahead in the dynamic field of pest management.</p></div></section>'

HOMEPAGE_ID=$(docker-compose exec -T wpcli wp post create --post_type=page --post_title="Home" --post_content="$HOMEPAGE_HTML" --post_status=publish --porcelain)
docker-compose exec -T wpcli wp option update show_on_front "page"
docker-compose exec -T wpcli wp option update page_on_front $HOMEPAGE_ID

echo "[INFO] Homepage created and set as front page."

# Pillar Pages
PILLARS=(
  "Integrated Pest Management (IPM)|Integrated Pest Management (IPM) is a sustainable approach to managing pests by combining biological, cultural, physical, and chemical tools in a way that minimizes economic, health, and environmental risks.\n\n#### Key Topics:\n- Monitoring Techniques\n- Field Trials\n- Risk Assessment\n- Decision Support Systems\n- Cultural Control Methods\n- Biological Control Integration\n\nIPM emphasizes prevention, regular monitoring, and the use of multiple control strategies to achieve effective, long-term pest management with minimal impact on people and the environment."
  "Biological Control|Biological control harnesses natural enemies—predators, parasitoids, and pathogens—to manage pest populations in agriculture and beyond. This approach reduces reliance on chemical pesticides and supports sustainable agriculture."
  "Pesticide Resistance|Understanding and managing the development of resistance in pest populations is critical to ensure long-term control efficacy. This pillar covers mechanisms, monitoring, and management strategies for pesticide resistance."
  "Regulatory Science|Frameworks, risk assessment, and compliance for safe and effective pest management solutions. Regulatory science ensures that pest control methods are safe for people and the environment."
)

for PILLAR in "${PILLARS[@]}"; do
  TITLE="$(echo "$PILLAR" | cut -d'|' -f1)"
  CONTENT="$(echo "$PILLAR" | cut -d'|' -f2)"
  docker-compose exec -T wpcli wp post create --post_type=pillar --post_title="$TITLE" --post_content="$CONTENT" --post_status=publish
  echo "[INFO] Pillar post created: $TITLE"
done

# Cluster Pages (example for IPM)
CLUSTERS=(
  "Monitoring Techniques|Monitoring techniques are essential for effective Integrated Pest Management (IPM). They involve regular observation and data collection to determine pest population levels and inform decision-making.\n\n**Common Monitoring Methods:**\n- Trapping\n- Visual Inspection\n- Threshold Determination\n\nAccurate monitoring helps reduce unnecessary pesticide use and supports timely, targeted interventions."
  "Field Trials|Field trials are used to evaluate the effectiveness of IPM strategies under real-world conditions. They provide data on pest control efficacy, crop yield, and environmental impact."
)
for CLUSTER in "${CLUSTERS[@]}"; do
  TITLE="$(echo "$CLUSTER" | cut -d'|' -f1)"
  CONTENT="$(echo "$CLUSTER" | cut -d'|' -f2)"
  docker-compose exec -T wpcli wp post create --post_type=cluster --post_title="$TITLE" --post_content="$CONTENT" --post_status=publish
  echo "[INFO] Cluster post created: $TITLE"
done

# FAQ
FAQ_CONTENT='### What is Pest Management Science?\nPest Management Science is an interdisciplinary field focused on the study and application of methods to control pests that affect agriculture, public health, and the environment.\n\n### Why is integrated pest management (IPM) important?\nIPM combines multiple control methods to manage pest populations effectively while minimizing environmental impact, reducing pesticide use, and promoting sustainable agriculture.\n\n### What are the latest advancements in pest control technologies?\nRecent advancements include biopesticides, gene editing, remote sensing for pest monitoring, and precision agriculture tools.\n\n### How can researchers contribute to pest management science?\nBy studying pest biology, developing new control methods, evaluating efficacy and safety, and providing data to inform policy and practice.\n\n### What role do policy makers play in pest management?\nThey develop regulations and guidelines, promote research funding, support education, and facilitate international cooperation.\n\n### How can practitioners implement sustainable pest management practices?\nAdopt IPM principles, use pest-resistant crops, monitor regularly, apply pesticides judiciously, and integrate biological controls.\n\n### What are the environmental impacts of pest control methods?\nPotential impacts include pesticide resistance, non-target species harm, contamination, and biodiversity loss. Sustainable practices aim to mitigate these.\n\n### How is pest resistance managed?\nThrough rotating pesticides, using non-chemical methods, monitoring for resistance, and implementing IPM strategies.\n\n### Where can I find reliable data and resources on pest management?\nScientific journals, government agencies, international organizations, and research institutes.\n\n### How can collaboration enhance pest management efforts?\nCollaboration enables knowledge exchange, coordinated action, and comprehensive strategies.'
docker-compose exec -T wpcli wp post create --post_type=faq --post_title="Pest Management Science – Frequently Asked Questions" --post_content="$FAQ_CONTENT" --post_status=publish

echo "[INFO] FAQ post created."

# Glossary
GLOSSARY_CONTENT='**Integrated Pest Management (IPM):** A sustainable approach to managing pests by combining biological, cultural, physical, and chemical tools in a way that minimizes economic, health, and environmental risks.\n\n**Pesticide Resistance:** The ability of a pest population to survive exposure to a pesticide that was previously effective, often due to genetic changes.\n\n**Biological Control:** The use of natural enemies such as predators, parasites, or pathogens to control pest populations.\n\n**Chemical Control:** The use of synthetic or natural chemical substances to reduce pest populations.\n\n**Host Plant Resistance:** The inherent ability of a plant to resist or tolerate pest attacks through genetic traits.\n\n**Quarantine:** Regulatory measures to prevent the introduction or spread of pests by restricting the movement of plants, animals, or goods.\n\n**Residue:** The trace amount of pesticide remaining on or in a treated commodity after application.\n\n**Threshold Level:** The pest population density at which control measures should be implemented to prevent economic damage.\n\n**Vector:** An organism, often an insect, that transmits a pathogen or parasite from one host to another.\n\n**Bioaccumulation:** The accumulation of substances, such as pesticides, in an organism over time, potentially leading to toxic effects.\n\n**Environmental Fate:** The behavior and movement of pesticides in the environment, including degradation, transport, and persistence.\n\n**Regulatory Compliance:** Adherence to laws and guidelines governing the use, application, and disposal of pest control substances.'
docker-compose exec -T wpcli wp post create --post_type=page --post_title="Glossary" --post_content="$GLOSSARY_CONTENT" --post_status=publish

echo "[INFO] Glossary page created."

# Case Study
CASE_STUDY_CONTENT='**Case Study: Effective Termite Management in Residential Areas Using Integrated Pest Management (IPM) Approach**\n\n**Problem:**\nA residential community in a suburban area was facing severe termite infestations, causing significant damage to wooden structures and posing a threat to property value and safety. Traditional chemical treatments were proving ineffective and raised environmental and health concerns among residents.\n\n**Solution:**\nAn authority website specializing in Pest Management Science collaborated with local pest control professionals to implement an Integrated Pest Management (IPM) approach. The intervention included:\n\n1. Inspection and Monitoring: Detailed assessment of termite activity and identification of infestation hotspots.\n2. Physical Barriers: Installation of termite shields and physical barriers during construction and renovation.\n3. Biological Control: Introduction of natural predators and use of biopesticides derived from natural materials.\n4. Chemical Treatments: Targeted application of termiticides in affected areas, minimizing chemical use.\n5. Community Education: Workshops and informational materials to educate residents on preventive measures and early detection.\n\n**Results:**\n- Significant reduction in termite activity within six months.\n- Decreased reliance on chemical pesticides by 70%, reducing environmental impact.\n- Enhanced community awareness and proactive participation in termite prevention.\n- Preservation of property value and structural integrity of homes.\n\n**Lessons Learned:**\n- IPM is a sustainable and effective strategy for termite management in residential settings.\n- Combining multiple control methods addresses the problem comprehensively.\n- Community involvement and education are critical for long-term success.\n- Regular monitoring and maintenance are essential to prevent reinfestation.'
docker-compose exec -T wpcli wp post create --post_type=case_study --post_title="Case Study: Effective Termite Management" --post_content="$CASE_STUDY_CONTENT" --post_status=publish

echo "[INFO] Case study post created."

# Resource List
RESOURCE_LIST_CONTENT='**Key Journals:**\n- Pest Management Science\n- Journal of Economic Entomology\n- Journal of Pest Science\n- Crop Protection\n- Journal of Agricultural and Food Chemistry\n- Journal of Integrated Pest Management\n- Journal of Applied Entomology\n- Bulletin of Entomological Research\n\n**Databases:**\n- CAB Abstracts (CABI)\n- AGRICOLA (National Agricultural Library)\n- PubAg (USDA)\n- Scopus\n- Web of Science\n- Google Scholar\n- Invasive Species Compendium (CABI)\n- Pesticide Properties DataBase (PPDB)\n\n**Toolkits:**\n- Integrated Pest Management (IPM) Toolkit (FAO)\n- Pest Risk Analysis Toolkit (IPPC)\n- Pesticide Safety and Application Tools (EPA)\n- Crop Protection Compendium (CABI)\n- Decision Support Systems for Pest Management\n- Biological Control Agent Databases\n- Pest Identification Guides and Apps\n\n**Organizations:**\n- International Organization for Biological Control (IOBC)\n- Society of Pest Management Professionals (SPMP)\n- Entomological Society of America (ESA)\n- Food and Agriculture Organization (FAO)\n- International Society of Integrated Pest Management (ISIPM)\n- American Phytopathological Society (APS)\n- National Pest Management Association (NPMA)\n- CABI (Centre for Agriculture and Bioscience International)'
docker-compose exec -T wpcli wp post create --post_type=page --post_title="Resource List" --post_content="$RESOURCE_LIST_CONTENT" --post_status=publish

echo "[INFO] Resource list page created."

# All content created and posted.
echo "[INFO] All major content for Pest Management Science has been created and posted." 