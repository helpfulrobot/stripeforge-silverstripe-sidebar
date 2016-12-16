<% if LinkOrSection = section %>
  <% if $Children %>
    <% loop $Children %>
      <li>
        <a href="$Link" class="$LinkingMode" title="$Title aufrufen">
          $MenuTitle
        </a>
        <% if $Children %>
          <ul>
            <% include SidebarNavigation %>
          </ul>
        <% end_if %>
      </li>
    <% end_loop %>
  <% end_if %>
<% end_if %>