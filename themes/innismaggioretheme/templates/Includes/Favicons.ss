<% if $SiteConfig.Favicon %>
    <link rel="shortcut icon" href="{$SiteConfig.Favicon.ScaleMaxWidth(128).Link()}" />
    <link rel="icon" type="image/png" sizes="32x32" href="{$SiteConfig.Favicon.Fill(32, 32).Link()}">
    <link rel="icon" type="image/png" sizes="16x16" href="{$SiteConfig.Favicon.Fill(16, 16).Link()}">
<% else %>
    <link rel="shortcut icon" href="{$themedResourceURL('favicons/favicon.ico')}" />
    <link rel="icon" type="image/png" sizes="32x32" href="$themedResourceURL('favicons/favicon-32x32.png')">
    <link rel="icon" type="image/png" sizes="16x16" href="$themedResourceURL('favicons/favicon-16x16.png')">
<% end_if %>
<link rel="apple-touch-icon" sizes="180x180" href="$themedResourceURL('favicons/apple-touch-icon.png')">
<link rel="manifest" href="$themedResourceURL('favicons/site.webmanifest')">
<link rel="mask-icon" href="$themedResourceURL('favicons/safari-pinned-tab.svg')" color="#051e2d">
<meta name="msapplication-TileColor" content="#051e2d">
<meta name="msapplication-config" content="$themedResourceURL('favicons/browserconfig.xml')">
<meta name="theme-color" content="#ffffff">
