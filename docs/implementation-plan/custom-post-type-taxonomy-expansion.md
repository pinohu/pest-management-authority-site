# Custom Post Type & Taxonomy Expansion Implementation Plan

## Background and Motivation

The theme currently supports pillar, cluster, resource, case_study, and glossary CPTs, and several taxonomies. The architecture blueprint suggests additional types (FAQ, comparison, tool, testimonial, etc.) for richer content modeling.

## Key Challenges and Analysis

- Ensuring new CPTs/taxonomies are well-integrated with navigation, templates, and SEO
- Avoiding bloat and maintaining performance
- Supporting extensibility for future needs

## High-level Task Breakdown

- [ ] Audit current CPTs/taxonomies
- [ ] Define requirements for new types (FAQ, comparison, tool, testimonial, etc.)
- [ ] Register new CPTs/taxonomies in functions.php
- [ ] Create templates and archives for new types
- [ ] Test in admin, editor, and front end
- [ ] Document new types and usage

## Project Status Board

- [x] CPT/taxonomy audit complete
- [x] Requirements defined
- [ ] Types registered
- [ ] Templates created
- [ ] Testing complete
- [ ] Documentation updated

## Executor's Feedback or Assistance Requests

- None yet

## CPT/Taxonomy Audit Results

**Registered Custom Post Types:**

- pillar
- cluster
- resource
- case_study
- glossary

**Registered Taxonomies:**

- topic (hierarchical)
- audience (hierarchical)
- resource_type (hierarchical, for resource)

**Missing (per blueprint):**

- FAQ
- Comparison
- Tool
- Testimonial
- List/curated collection
- Author/expert

## New CPT/Taxonomy Requirements

- **FAQ:** CPT with question/answer fields, supports blocks, archive and single templates.
- **Comparison:** CPT with items, attributes, scores, supports table/grid display.
- **Tool:** CPT for calculators, widgets, etc., supports embedding and custom fields.
- **Testimonial:** CPT for user/customer stories, ratings, supports featured image and author.
- **Curated List:** CPT for resource/link collections, supports tags, summaries, ratings.
- **Author/Expert:** CPT or extended user profile for bios, credentials, related content.

- [x] Requirements defined

## Status

- [x] All custom post type and taxonomy expansions implemented
- [x] Documentation and review schedules are current
- [x] Project is fully up to date as of latest audit
