# Snippetses

*...because "snippets" was taken...*

Create snippets, content templates or terms and inject variables into them.

## Usage

- Go to `Admin > Snippets > Add New`
- Put `Hi [name]!` in the content and save
- Note the Post ID from the URL
- In another post, write `[snippet id="42" name="Rich"]`
    - The `id` refers to the Post ID of the snippet
    - Other attributes refer to placeholders in the Variable's content
- View the content and you should see `Hi Rich!`

You can have any number of additional attributes and they can be called anything you like as long as they're lowercase.

You can also use an enclosing shortcode (e.g. `[snippet id="42"]Hello, World![/snippet]`) to pass larger content (including other shortcodes!) to the `[content]` placeholder in the snippet.

## Use Cases

- Content needs to be shown on multiple, but not all, pages
- Addresses shown in multiple places
- Similar pricing structure repeated throughout site
- Up-to-date phone number needs to be on several articles
- Content templates injecting parts that need to change