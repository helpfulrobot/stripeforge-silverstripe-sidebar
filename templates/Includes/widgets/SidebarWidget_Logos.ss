<% if $Logos %>
  <div class="sidebar-widget__logos">
    <% loop $Logos.Sort(SortOrder) %>
      <% if $WebsiteLink %>
        <a href="$WebsiteLink" target="_blank">
      <% end_if %>
      $ScaleWidth(233)
      <% if $WebsiteLink %>
        </a>
      <% end_if %>
    <% end_loop %>
  </div>
<% end_if %>