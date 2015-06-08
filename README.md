# Snippetses

*...because "snippets" was taken...*

Create snippets, content templates or terms and inject variables into them.

## Basic Usage

1. Go to `Admin > Snippets > Add New`
1. Put `Hi {name}!` in the content and save — note the ID in the URL!
1. In another post, write `[snippet id="42" name="Rich"]`
1. View the content and you should see `Hi Rich!`

The `id` is the ID of the snippet and `name` will replace the `{name}` placeholder in the snippet.

## Use Cases

- Content needs to be shown on multiple, but not all, pages
- Addresses shown in multiple places
- Similar pricing structure repeated throughout site
- Up-to-date phone number needs to be on several articles
- Content templates injecting parts that need to change

## Snippets Placeholders

Snippet placeholders use the same syntax as shortcodes, except that they use braces (`{` & `}`, e.g. `{foo}`) instead of brackets (`[` & `]`),  and are replaced with the values passed in the shortcode.

Enclosing shortcodes can be used to pass larger texts to the Snippet with the `{content}` placeholder, including other shortcodes. You can also set a `default` value in the placeholder in case a parameter isn't provided.

See [Full Example](#full-example) below for examples of these features.

## Shortcode Parameters

- `id` can be used to get a Snippet
- `inline` can be set to keep the Snippet on one line
- All other parameters will replace placeholders
- Anything inside an enclosing shortcode (e.g. `[shortcode]Content[/shortcode]` rather than `[shortcode]`) will replace the `{content}` placeholder

## Full Example

    Assume another plugin has the shortcode `[date]` which outputs the current date

1. Create a Snippet as follows:

    1. Title: `Favorite Colors`
    1. Content: `{first_color} & {second_color default="green"} {content}`

1. In another post, add the content:

    `Favorite colors: [snippet id="42" inline="yes" first_color="red"]as of [date][/snippet]`

1. What will be shown:

    Favorite colors: red & green as of 29<sup>th</sup> May 2015