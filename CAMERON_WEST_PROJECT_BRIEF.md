# Cameron West Author Website — Project Brief
### Redesign of cameronwestauthor.com

---

## Project Overview

A sophisticated redesign of the author website for **Cameron West, PhD** — New York Times bestselling author of *First Person Plural: My Life as a Multiple* (25th Anniversary Edition). The site serves readers, mental health professionals, DID advocates, and media.

---

## Design Direction

**Aesthetic**: Luxury editorial / refined dark — sophisticated, literary, emotionally resonant. Think high-end memoir meets psychological depth. The design should feel like the book cover itself: stark, serious, intimate, and unforgettable.

**Mood**: Quiet intensity. Not flashy — authoritative and deeply human.

---

## Color Palette (Derived from Book Cover)

| Role | Color | Notes |
|---|---|---|
| **Background** | `#0A0A0A` – `#111111` | Near-black, deep charcoal |
| **Primary Text** | `#F0EDE8` | Warm off-white, not stark |
| **Accent / Highlight** | `#C4805A` | Warm copper/terracotta (from Oprah quote & badge) |
| **Secondary Accent** | `#8B6F5E` | Muted bronze/brown |
| **Surface / Cards** | `#1A1918` | Slightly lighter than background |
| **Borders / Dividers** | `#2E2B28` | Subtle warm dark |
| **Quote / Pull Text** | `#D4C5B5` | Warm mid-tone cream |

---

## Typography (Derived from Book Cover)

### Display / Hero Font
- **Recommended**: `Playfair Display` (Google Fonts) — matches the serif weight of "FIRST PERSON" on the cover
- **Alternative**: `Cormorant Garamond` — even more refined and literary
- **Usage**: H1, section titles, book titles

### Accent / Italic Font
- **Recommended**: `Playfair Display Italic` or `EB Garamond Italic` — matches the italicized "PLURAL" and "My Life as a Multiple"
- **Usage**: Subtitles, pull quotes, italicized highlights

### Body / UI Font
- **Recommended**: `Lora` — warm, readable serif that complements display fonts
- **Alternative**: `Source Serif 4` — clean and editorial
- **Usage**: Body copy, navigation, metadata

### Supporting Sans (Sparse Use)
- **Recommended**: `Cormorant SC` (small caps) or `Cinzel` — for labels, badges, ALL CAPS callouts like "NEW YORK TIMES BESTSELLER"
- **Usage**: Nav links, section labels, metadata tags

---

## Font Size Scale

```css
--text-xs:    0.75rem;   /* Labels, metadata */
--text-sm:    0.875rem;  /* Nav, captions */
--text-base:  1rem;      /* Body */
--text-lg:    1.25rem;   /* Lead paragraphs */
--text-xl:    1.5rem;    /* Subheadings */
--text-2xl:   2rem;      /* Section headings */
--text-3xl:   3rem;      /* Book titles */
--text-hero:  5-8vw;     /* Hero headline */
```

---

## Layout Principles

- **Single-column editorial flow** — wide gutters, generous line-height (1.8)
- **Asymmetric hero** — book cover image overlapping text, echoing the layered face effect on the cover
- **Section dividers**: thin copper/terracotta rules (`1px solid #C4805A`)
- **Generous whitespace** — let content breathe
- **No busy backgrounds** — subtle grain texture overlay acceptable
- **Sticky navigation**: dark, minimal, transparent on scroll

---

## Site Structure (Pages)

### 1. Home (index.html)
- **Hero**: Full-bleed dark background, book cover image (tilted/floating), author name large, Oprah quote in copper accent
- **Hook section**: "NYT Bestseller · 22 Countries · Oprah's Pick" badges
- **About teaser**: Short bio with photo, link to About page
- **Books preview**: Both books with cover thumbnails
- **Reviews teaser**: 2–3 pull quotes
- **CTA**: Buy the book buttons (Amazon / Barnes & Noble links)

### 2. About (about section or page)
- Full biography
- Author photo
- PhD credentials, DID journey summary
- Current projects mention

### 3. Books (books.html or section)
- *First Person Plural* — featured prominently (25th Anniversary Edition)
- *The Medici Dagger* — secondary feature
- Buy links for each (Amazon, B&N, Kindle)

### 4. Reviews (reviews section)
- Editorial reviews (Publisher's Weekly, Library Journal)
- Reader reviews (Amazon, Goodreads, B&N)
- Star ratings visual if applicable

### 5. Resources (resources.html)
- Links to DID/trauma professional organizations
- Already exists — preserve content, restyle

### 6. Contact (contact.html)
- Simple contact form
- Already exists — preserve, restyle

---

## Key UI Components

### Navigation
```
[Cameron West]    Home  About  Books  Reviews  Resources  Contact
```
- Dark background, `Lora` or small-caps sans for links
- Copper underline on hover/active
- Mobile: hamburger menu

### Hero Section
- Background: `#0A0A0A` with subtle grain
- Book cover: large, slightly angled, with drop shadow
- Headline: Author name in `Playfair Display`, large
- Subhead: Book title in italic
- Quote: Oprah endorsement in copper

### Book Cards
- Dark card background `#1A1918`
- Cover image left, text right
- Title in display font
- Description in body font
- CTA buttons: copper outline style

### Review Blockquotes
```css
border-left: 3px solid #C4805A;
padding-left: 1.5rem;
font-style: italic;
color: #D4C5B5;
```

### Buttons
- **Primary**: Copper background `#C4805A`, dark text, no border-radius or subtle 2px
- **Secondary**: Transparent, copper border, copper text
- **Hover**: Slight brightness increase + subtle glow

---

## CSS Variables (Root)

```css
:root {
  --color-bg:          #0A0A0A;
  --color-surface:     #1A1918;
  --color-border:      #2E2B28;
  --color-text:        #F0EDE8;
  --color-text-muted:  #D4C5B5;
  --color-accent:      #C4805A;
  --color-accent-dark: #8B6F5E;

  --font-display: 'Playfair Display', Georgia, serif;
  --font-body:    'Lora', Georgia, serif;
  --font-label:   'Cinzel', serif;

  --max-width:    1100px;
  --gutter:       clamp(1.5rem, 5vw, 4rem);
  --section-gap:  clamp(4rem, 10vw, 8rem);
}
```

---

## Google Fonts Import

```html
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;0,900;1,400;1,700&family=Lora:ital,wght@0,400;0,500;1,400&family=Cinzel:wght@400;600&display=swap" rel="stylesheet">
```

---

## Existing Site Notes (cameronwestauthor.com)

- Built on a simple HTML/CSS template (Colorlib)
- Single-page with anchor navigation + separate resources/contact pages
- Assets: `img/FPP.png`, `img/FPP-banner.png`, `img/cameron_west.jpg`, `img/signature.png`
- Review logos: `img/goodreads.png`, `img/amazon.png`, `img/barnes.png`
- **Keep all existing content** — this is a visual/UX redesign only
- GitHub repo: `https://github.com/seanphillip/cameronwestauthor`

---

## Development Stack

- Plain **HTML5 / CSS3 / Vanilla JS** (no framework needed)
- CSS custom properties for theming
- Responsive: mobile-first, breakpoints at 768px and 1100px
- Hosted via GitHub Pages or existing host

---

## Priorities (Ranked)

1. Hero section — first impression must be stunning
2. Book showcase — *First Person Plural* 25th Anniversary Edition is the hero product
3. Typography — must feel premium and literary
4. Reviews — social proof is central to the author's credibility
5. Mobile responsiveness
6. Contact / Resources pages

---

## Reference Inspiration

- Dark literary author sites (Cormac McCarthy, Donna Tartt publishers)
- High-end memoir publisher pages
- The book cover itself — **always return to the cover as the design source of truth**

---

*Last updated: March 2026*
*Project owner: Sean Phillip / Cameron West*
*Repo: github.com/seanphillip/cameronwestauthor*
