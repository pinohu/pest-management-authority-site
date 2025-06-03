import React from 'react';

interface ExportManagerProps {
  components: { name: string; Component: React.FC; }[];
}

export function ExportManager({ components }: ExportManagerProps) {
  const handleExport = (name: string) => {
    // Placeholder: In the future, this will use provided HTML/CSS/notes
    alert(`Exporting ${name} to WordPress...`);
  };

  return (
    <div style={{ padding: 24 }}>
      <h2>Export Manager</h2>
      <ul style={{ listStyle: 'none', padding: 0 }}>
        {components.map(({ name, Component }) => (
          <li key={name} style={{ marginBottom: 32, border: '1px solid #eee', borderRadius: 8, padding: 16 }}>
            <h3>{name}</h3>
            <div style={{ marginBottom: 12 }}>
              <Component />
            </div>
            <button onClick={() => handleExport(name)}>
              Export to WordPress
            </button>
            <div style={{ marginTop: 8, fontSize: 12, color: '#888' }}>
              {/* Placeholder for HTML/CSS export preview */}
              <div><strong>HTML:</strong> <pre>{'<!-- WordPress HTML will appear here -->'}</pre></div>
              <div><strong>CSS:</strong> <pre>{'/* Extracted CSS will appear here */'}</pre></div>
            </div>
          </li>
        ))}
      </ul>
    </div>
  );
} 