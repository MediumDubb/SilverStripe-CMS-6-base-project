<head>
    <% base_tag %>
    <% include GoogleTagManagerScript %>
    <title>
        <% if $MetaTitle %>$MetaTitle<% else %>$Title<% end_if %> &raquo; $SiteConfig.Title
    </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    $MetaTags(false)
    <% if $SiteConfig.Favicon %>
        <link rel="shortcut icon" href="{$SiteConfig.Favicon.ScaleMaxWidth(128).Link()}" />
    <% else %>
        <link rel="shortcut icon" href="{$resourceURL('themes/<replace-theme>/images/favicon.ico')}" />
    <% end_if %>
    <% include GoogleFonts %>
    <% include Favicons %>
</head>
