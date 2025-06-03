import React from 'react';
import { ExportManager } from './ExportManager/ExportManager';

interface ComponentGalleryProps {
  components: { name: string; Component: React.FC; code: string }[];
}

export function ComponentGallery({ components }: ComponentGalleryProps) {
  return (
    <div style={{ padding: 24 }}>
      <h1>Component Gallery</h1>
      <ul style={{ listStyle: 'none', padding: 0 }}>
        {components.map(({ name, Component, code }) => (
          <li key={name} style={{ marginBottom: 40, border: '1px solid #ddd', borderRadius: 8, padding: 16 }}>
            <h2>{name}</h2>
            <div style={{ marginBottom: 12 }}>
              <Component />
            </div>
            <details>
              <summary>Show Code</summary>
              <pre style={{ background: '#f7f7f7', padding: 12, borderRadius: 4 }}>{code}</pre>
            </details>
          </li>
        ))}
      </ul>
      <ExportManager components={components.map(({ name, Component }) => ({ name, Component }))} />
    </div>
  );
} 