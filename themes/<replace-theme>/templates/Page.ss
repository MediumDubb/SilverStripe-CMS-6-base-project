<!DOCTYPE html>
<html lang="{$ContentLocale}">
<% include Head %>
<body<% if $i18nScriptDirection %> dir="$i18nScriptDirection"<% end_if %>>
<% include GoogleTagManagerNoScript %>
<% include Header %>
<main id="main" class="main" tabindex="-1">
    <% if not $isHomePage %>
        $Breadcrumbs
    <% end_if %>
    <div class="page-layout">
        $Layout
    </div>
</main>
<% include Footer %>
<% include SearchOverlay %>
</body>
</html>
