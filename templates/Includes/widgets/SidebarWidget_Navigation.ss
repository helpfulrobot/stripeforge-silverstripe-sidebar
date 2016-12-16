<% if $Page.Menu(2) %>
  <nav class="sidebar__navigation">
    <% with $Page.Level(1) %>
      <ul>
        <% include SidebarNavigation %>
      </ul>
    <% end_with %>
  </nav>
<% end_if %>