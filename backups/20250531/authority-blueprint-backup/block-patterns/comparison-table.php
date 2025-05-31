<?php
/**
 * Block Pattern: Comparison Table/List
 * Description: Accessible, responsive comparison table or card grid with ARIA and mobile-first design.
 */
?>
<!-- wp:group {"className":"comparison-table-section"} -->
<div class="wp-block-group comparison-table-section" aria-label="Comparison Table">
	<!-- wp:heading {"level":2} -->
	<h2>Comparison Table</h2>
	<!-- /wp:heading -->
	<!-- wp:table {"className":"comparison-table"} -->
	<table class="comparison-table" role="table">
		<thead>
			<tr>
				<th scope="col">Feature</th>
				<th scope="col">Option A <span aria-label="Recommended" title="Recommended">⭐</span></th>
				<th scope="col">Option B</th>
				<th scope="col">Option C</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th scope="row">Price</th>
				<td>$10/mo</td>
				<td>$12/mo</td>
				<td>$8/mo</td>
			</tr>
			<tr>
				<th scope="row">Support</th>
				<td>24/7 <span aria-label="Best" title="Best">🏆</span></td>
				<td>Email Only</td>
				<td>Business Hours</td>
			</tr>
			<tr>
				<th scope="row">Free Trial</th>
				<td>Yes</td>
				<td>No</td>
				<td>Yes</td>
			</tr>
			<tr>
				<th scope="row">Pros</th>
				<td>Affordable, Great Support</td>
				<td>More Features</td>
				<td>Lowest Price</td>
			</tr>
			<tr>
				<th scope="row">Cons</th>
				<td>Fewer Integrations</td>
				<td>Expensive</td>
				<td>Limited Support</td>
			</tr>
		</tbody>
	</table>
	<!-- /wp:table -->
	<!-- wp:paragraph {"className":"comparison-table-note"} -->
	<p class="comparison-table-note">⭐ Recommended | 🏆 Best Support</p>
	<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
<style>
.comparison-table-section { margin-bottom: 2rem; }
.comparison-table { width: 100%; border-collapse: collapse; }
.comparison-table th, .comparison-table td { border: 1px solid #e0e0e0; padding: 0.75rem; text-align: left; }
.comparison-table th[scope="col"] { background: #f8f8f8; }
.comparison-table th[scope="row"] { background: #f3f6fa; }
.comparison-table-note { font-size: 0.9em; color: #666; margin-top: 0.5rem; }
@media (max-width: 600px) {
  .comparison-table, .comparison-table thead, .comparison-table tbody, .comparison-table th, .comparison-table td, .comparison-table tr { display: block; width: 100%; }
  .comparison-table thead { display: none; }
  .comparison-table tr { margin-bottom: 1.5rem; border-bottom: 2px solid #e0e0e0; }
  .comparison-table td, .comparison-table th[scope="row"] { padding: 0.5rem; border: none; position: relative; }
  .comparison-table td:before { content: attr(data-label); font-weight: bold; display: block; margin-bottom: 0.25rem; }
}
</style> 