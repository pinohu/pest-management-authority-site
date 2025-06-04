import React from "react";
import { ExportManager } from "./ExportManager/ExportManager";
import { Hero } from "./Hero/Hero";

interface ComponentGalleryProps {
  components: { name: string; Component: React.FC; code: string }[];
}

const heroCode = `// Hero component usage example
<Hero
  title="Welcome to Authority Blueprint"
  subtitle="Build your next project with flexible, modern UI blocks."
  imageUrl="https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=800&q=80"
  variant="split"
  ctaText="Get Started"
  ctaHref="#"
/>
`;

const components = [
  {
    name: "Hero",
    Component: () => (
      <Hero
        title="Welcome to Authority Blueprint"
        subtitle="Build your next project with flexible, modern UI blocks."
        imageUrl="https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=800&q=80"
        variant="split"
        ctaText="Get Started"
        ctaHref="#"
      />
    ),
    code: heroCode,
  },
  // Add more components here
];

export function ComponentGallery({
  components: _components,
}: ComponentGalleryProps) {
  return (
    <div style={{ padding: 24 }}>
      <h1>Component Gallery</h1>
      <ul style={{ listStyle: "none", padding: 0 }}>
        {components.map(({ name, Component, code }) => (
          <li
            key={name}
            style={{
              marginBottom: 40,
              border: "1px solid #ddd",
              borderRadius: 8,
              padding: 16,
            }}
          >
            <h2>{name}</h2>
            <div style={{ marginBottom: 12 }}>
              <Component />
            </div>
            <details>
              <summary>Show Code</summary>
              <pre
                style={{ background: "#f7f7f7", padding: 12, borderRadius: 4 }}
              >
                {code}
              </pre>
            </details>
          </li>
        ))}
      </ul>
      <ExportManager
        components={components.map(({ name, Component }) => ({
          name,
          Component,
        }))}
      />
    </div>
  );
}
