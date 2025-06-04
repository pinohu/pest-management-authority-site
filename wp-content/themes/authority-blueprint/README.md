# Pest Management Science Authority Blueprint Theme: Developer Guide

## Atomic Structure

- All templates use atomic parts in `/parts` (header, footer, loop, content, etc.)
- Block patterns in `/block-patterns` for rapid layout
- FSE block templates in `/templates` (home, page, single, archive, 404)

## Full Site Editing (FSE) & Block Templates

- Uses `/templates/*.html` for advanced layouts
- Patterns referenced via `wp:pattern` for modularity
- Custom templates defined in `theme.json`

## Extensibility Hooks

- `authority_blueprint_schema` filter: Extend schema.org JSON-LD output
- `authority_blueprint_performance_metrics` action: Log or enhance performance metrics
- `authority_blueprint_before_header`, `authority_blueprint_after_header`, `authority_blueprint_before_footer`, `authority_blueprint_after_footer`: Inject content into theme parts

## Schema & Performance APIs

- Schema output in `<head>` via `wp_head` (filterable)
- Performance metrics in footer via `wp_footer` (action hook)

## Best Practices

- Use child themes or plugins to extend via hooks/filters
- Register new block patterns in `/block-patterns` for pest management layouts
- Add new FSE templates in `/templates`
- Follow accessibility and SEO best practices in all customizations

## Example: Extending Schema

```php
add_filter('authority_blueprint_schema', function($schema, $post) {
    $schema['publisher'] = [
        '@type' => 'Organization',
        'name' => 'Pest Management Science',
    ];
    return $schema;
}, 10, 2);
```

## Example: Logging Performance

```php
add_action('authority_blueprint_performance_metrics', function($metrics) {
    error_log('Theme performance: ' . print_r($metrics, true));
});
```
