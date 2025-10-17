<% if $Results.MoreThanOnePage %>
    <div class="paginated-list" data-type="pagination">
        <ul class="pagination<% if $Results.NotFirstPage %> not-first<% else_if $Results.NotLastPage %> not-last<% end_if %>">
            <% if $Results.NotFirstPage %>
                <li class="page-item prev">
                    <a href="$Results.PrevLink" aria-label="View the previous page">«</a>
                </li>
            <% end_if %>
            <% loop $Results.Pages %>
                <% if $CurrentBool %>
                    <li class="page-item current">$PageNum</li>
                <% else %>
                    <li class="page-item">
                        <a href="$Link" aria-label="View page number $PageNum" class="go-to-page">$PageNum</a>
                    </li>
                <% end_if %>
            <% end_loop %>
            <% if $Results.NotLastPage %>
                <li class="page-item next">
                    <a href="$Results.NextLink" aria-label="View the next page">»</a>
                </li>
            <% end_if %>
        </ul>
    </div>
<% end_if %>
