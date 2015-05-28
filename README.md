# Snippetses

*...because "snippets" was taken...*

Create content templates, snippets or terms and inject variables into them.

## Usage

- Go to `Admin > Snippets > Add New`
- Give it the title `Greeting` and the content `Hi [name]!`
- Somewhere in your content, add `[snippet title="Greeting" name="Rich"]`
    - The `title` refers to the title of the Variable
    - Alternatively, use `id` and provide the post ID
    - Other attributes refer to placeholders in the Variable's content
- View the content and you should see `Hi Rich!`

You can have any number of additional attributes and they can be called anything you like as long as they're lowercase.

## Purpose

- Addresses shown in multiple places
- Similar pricing structure repeated throughout site
- Up-to-date phone number needs to be on several articles
- Content templates injecting parts that need to change