# Variables

Create snippets, terms and fragments of content and inject variables into them.

## Usage

- Go to `Admin > Variables` and create a variable
- Give it the title `Greeting` and the content `Hi [name]!`
- Add this shortcode somewhere: `[variable var="Greeting" name="Rich"]`
    - The `var` refers to the title of the Variable
    - Other attributes refer to placeholders in the Variable's content
- View the page and you should see `Hi Rich!`

You can have any number of additional attributes and you can call them anything you like as long as they're lowercase.

## Query String

You can also inject variables from the query string. The query string name must be prepended with an underscore, e.g. `?_name=Rich` will match `[name]` in the Variable content.

I haven't worked out a use for this yet...

## Purpose

- Addresses that change regularly
- Similar pricing structure repeated throughout site
- Up-to-date phone number needs to be on several articles
- Content templates injecting parts that need to change