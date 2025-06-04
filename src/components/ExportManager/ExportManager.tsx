import React from "react";

interface ExportManagerProps {
  components: { name: string; Component: React.FC }[];
}

const heroHtml = `<section class="hero hero--split">
  <div class="hero__content">
    <h1 class="hero__title">Welcome to Authority Blueprint</h1>
    <p class="hero__subtitle">Build your next project with flexible, modern UI blocks.</p>
    <a class="hero__cta" href="#">Get Started</a>
  </div>
  <div class="hero__image-wrapper">
    <img class="hero__image" src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=800&q=80" alt="" />
  </div>
</section>`;

const heroCss = `/* Hero component styles */
.hero {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  justify-content: center;
  padding: 3rem 1.5rem;
  background: #f8fafc;
  color: #222;
  min-height: 320px;
  width: 100%;
}
.hero__content {
  max-width: 700px;
  z-index: 2;
}
.hero__title {
  font-size: 2.5rem;
  font-weight: 700;
  margin-bottom: 1rem;
}
.hero__subtitle {
  font-size: 1.25rem;
  margin-bottom: 1.5rem;
  color: #555;
}
.hero__cta {
  display: inline-block;
  padding: 0.75rem 2rem;
  background: #0070f3;
  color: #fff;
  border-radius: 0.5rem;
  text-decoration: none;
  font-weight: 600;
  margin-top: 1rem;
  transition: background 0.2s;
}
.hero__cta:hover {
  background: #005bb5;
}
.hero--split {
  flex-direction: row;
  align-items: center;
  justify-content: space-between;
  gap: 2rem;
}
.hero__image-wrapper {
  flex: 1 1 40%;
  display: flex;
  align-items: center;
  justify-content: center;
}
.hero__image {
  max-width: 100%;
  height: auto;
  border-radius: 1rem;
  box-shadow: 0 2px 16px rgba(0,0,0,0.08);
}
@media (max-width: 900px) {
  .hero--split {
    flex-direction: column;
    gap: 1.5rem;
  }
  .hero__image-wrapper {
    width: 100%;
  }
}
@media (max-width: 600px) {
  .hero {
    padding: 2rem 0.5rem;
  }
  .hero__title {
    font-size: 2rem;
  }
  .hero__subtitle {
    font-size: 1rem;
  }
}`;

const heroNotes = `WordPress Conversion Notes:\n\n- Use the HTML as a block in the WordPress editor (Gutenberg Custom HTML block).\n- Add the CSS to your theme's stylesheet or via the Customizer > Additional CSS.\n- Replace static text/images with dynamic WordPress fields as needed.\n- For background or centered variants, adjust classes and structure as shown in the React component.\n- Ensure all class names are unique to avoid style conflicts.`;

export function ExportManager({ components }: ExportManagerProps) {
  const handleExport = (name: string) => {
    alert(`Exporting ${name} to WordPress...`);
  };

  return (
    <div style={{ padding: 24 }}>
      <h2>Export Manager</h2>
      <ul style={{ listStyle: "none", padding: 0 }}>
        {components.map(({ name, Component }) => (
          <li
            key={name}
            style={{
              marginBottom: 32,
              border: "1px solid #eee",
              borderRadius: 8,
              padding: 16,
            }}
          >
            <h3>{name}</h3>
            <div style={{ marginBottom: 12 }}>
              <Component />
            </div>
            <button onClick={() => handleExport(name)}>
              Export to WordPress
            </button>
            <div style={{ marginTop: 8, fontSize: 12, color: "#888" }}>
              {name === "Hero" ? (
                <>
                  <div>
                    <strong>HTML:</strong> <pre>{heroHtml}</pre>
                  </div>
                  <div>
                    <strong>CSS:</strong> <pre>{heroCss}</pre>
                  </div>
                  <div>
                    <strong>WordPress Notes:</strong> <pre>{heroNotes}</pre>
                  </div>
                </>
              ) : (
                <>
                  <div>
                    <strong>HTML:</strong>{" "}
                    <pre>{"<!-- WordPress HTML will appear here -->"}</pre>
                  </div>
                  <div>
                    <strong>CSS:</strong>{" "}
                    <pre>{"/* Extracted CSS will appear here */"}</pre>
                  </div>
                </>
              )}
            </div>
          </li>
        ))}
      </ul>
    </div>
  );
}
