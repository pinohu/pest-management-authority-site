# Block Pattern Enhancements Implementation Plan

## Background and Motivation
The Authority Blueprint theme leverages block patterns for rapid, consistent content creation. The architecture blueprint calls for a wide range of content types (FAQ, comparison, glossary, resource list, case study, etc.) that are not yet fully represented in the current block patterns directory.

## Key Challenges and Analysis
- Ensuring new patterns are accessible, responsive, and SEO-friendly
- Aligning pattern structure with content hub, cluster, and conversion page needs
- Supporting easy customization and extensibility

## High-level Task Breakdown
- [ ] Audit existing block patterns and identify gaps
- [ ] Define requirements and wireframes for each new pattern (FAQ, comparison, glossary, resource list, case study, etc.)
- [ ] Implement each pattern as a PHP file in block-patterns/
- [ ] Add pattern registration to functions.php
- [ ] Test in block editor and on front end for accessibility, responsiveness, and SEO
- [ ] Document usage in README

## Project Status Board
- [x] Block pattern audit complete
- [x] Requirements defined
- [x] FAQ Section pattern implemented
- [x] Comparison Table/List pattern implemented
- [ ] Glossary/definition list
- [ ] Resource list/downloads
- [ ] Case study pattern
- [ ] List page/curated collection
- [ ] Conversion/landing page pattern
- [ ] Author/expert bio
- [ ] Patterns registered
- [ ] Patterns tested
- [ ] Documentation updated

## Executor's Feedback or Assistance Requests
- None yet 

## Block Pattern Audit Results

**Current Patterns:**
- accessibility-announcement
- content-hub
- cta-section
- aspect-ratio-media
- feature-card
- mobile-form
- bottom-nav
- mobile-nav
- testimonial-section
- feature-list
- hero-section
- hero

**Missing (per blueprint):**
- FAQ section
- Comparison table/list
- Glossary/definition list
- Resource list/downloads
- Case study pattern
- List page/curated collection
- Conversion/landing page pattern
- Author/expert bio

- [x] Block pattern audit complete 

## Requirements & Wireframes for New Patterns

- **FAQ Section:** Accessible accordion, each item has question (heading) and answer (rich text), ARIA attributes, keyboard navigation, supports links and lists.
- **Comparison Table/List:** Responsive table or card grid, columns for features, supports icons, highlights, pros/cons, mobile stacking.
- **Glossary/Definition List:** Alphabetical list, each entry has term (heading) and definition (rich text), internal links to related terms.
- **Resource List/Downloads:** Grid/list of resources, file type icons, title, description, download link/button, supports tags.
- **Case Study Pattern:** Sections for problem, solution, results, author attribution, call to action, supports images and quotes.
- **Curated List Page:** List of links/resources, each with summary, category tags, optional rating or badge.
- **Conversion/Landing Page:** Hero, benefits/features, testimonials, form/CTA, trust indicators, minimal distractions.
- **Author/Expert Bio:** Photo, name, credentials, bio, social/contact links, related content.

- [x] Requirements/wireframes defined 

## Lessons Learned
- Use semantic table markup for accessibility and mobile-first CSS for stacking.
- ARIA labels and icons improve clarity for all users. 