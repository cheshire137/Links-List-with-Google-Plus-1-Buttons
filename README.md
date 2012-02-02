Links List with Google +1 Buttons
===
This is a WordPress plugin that provides a WordPress [shortcode](http://codex.wordpress.org/Shortcode) that will list your WordPress links with a [Google +1 button](http://www.google.com/+1/button/) for each.

Usage
--
Show all links in the link category 'Techy':

    <ul class="links-list">[plus-one-links category_name="Techy"]</ul>

Show all links in link categories 1 and 2, but don't include the Google +1 JavaScript (for when you will include it later):

    <ul>[plus-one-links category="1,2" include_plusone_script="no"]</ul>

Only output the JavaScript that will make all +1 buttons on the page display (should be output before +1 links):

    [plus-one-links only_plusone_script="yes"]

Output several link categories with the +1 JavaScript only output once:

    [plus-one-links only_plusone_script="yes"]
    <h2>First Category</h2>
    <ul>[plus-one-links category="1" include_plusone_script="no"]</ul>
    <h2>Second Category</h2>
    <ul>[plus-one-links category="2" include_plusone_script="no"]</ul>
    <h2>Third Category</h2>
    <p>[plus-one-links category="3" include_plusone_script="no" before="" after="<br/>"]</p>

Output links with a custom template:

    [plus-one-links category_name="Awesomeness" plusone_size="tall"]<a href="[url]" title="[desc]">[name]</a> [plusone][/plus-one-links]

Options
--
All the same options as the WordPress function [get_bookmarks()](http://codex.wordpress.org/Function_Reference/get_bookmarks) are provided.
- `before` - Content to show up before each link.  Defaults to `<li class="link">`.
- `after` - Content to show up after each link.  Defaults to `</li>`.
- `template` - The template that will be used to display each link.  Defaults to `<a href="[url]">[name]</a> - [desc]<br/>[plusone]`.  Recognized placeholder values:  `[url]` (link URL), `[name]` (link name), `[desc]` (link description), and `[plusone]` (Google +1 button).
- `plusone` - Whether to show a Google +1 button with each link.  Valid values:  `yes`, `no`.  Defaults to `yes`.
- `only_plusone_script` - Whether to only output JavaScript to make all Google +1 buttons display.  Valid values:  `yes`, `no`.  Defaults to `no`.  If set to `yes`, no links will be displayed and all other parameters will be ignored.
- `include_plusone_script` - Whether to include the JavaScript that will make +1 buttons show up.  Valid values:  `yes`, `no`.  Defaults to `yes`.  If you want to have several instances of `[plus-one-links]`, for outputting multiple categories in separate lists for example, you probably only want the `<script>` tag to be output once at the beginning.
- `plusone_size` - The size of the Google +1 button.  Valid values:  `small`, `standard`, `medium`, and `tall`.  [Examples here](http://www.google.com/webmasters/+1/button/).  Default value:  `small`.
- `plusone_annotation` - The style of the Google +1 text.  Valid values:  `inline`, `bubble`, and `none`.  [Examples here](http://www.google.com/webmasters/+1/button/).  Default value:  `inline`.
- `category` - Comma separated list of bookmark category ID's.
- `category_name` - Category name of a catgeory of bookmarks to retrieve. Overrides category parameter.
- `orderby` - Value to sort bookmarks on. Defaults to `name`.  Valid values:  `name`, `link_id`, `url`, `owner`, `rating`, `updated`, `visible`, `length`, `rand`.
- `order` - Sort order, ascending or descending for the orderby parameter.  Valid values:  `ASC`, `DESC`.
- `limit` - Maximum number of bookmarks to display. Defaults to `'-1'` (all bookmarks).
- `hide_invisible` - 1 causes only bookmarks with link_visible set to 'Y' to be retrieved.  Valid values:  `1`, `0`.
- `include` - Comma separated list of numeric bookmark IDs to include in the output. For example, `include="1,3,6"` means to display bookmark IDs 1, 3, and 6. If the include string is used, the category, category_name, and exclude parameters are ignored. Defaults to *(all Bookmarks)*.
- `exclude` - Comma separated list of numeric bookmark IDs to exclude. For example, `exclude="4,12"` means that bookmark IDs 4 and 12 will NOT be displayed. Defaults to *(exclude nothing)*.
- `search` - Searches link url, link name or link description like the search string.
