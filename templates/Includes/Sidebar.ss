<% cached 'sidebar', $CurrentLocale, $SidebarWidgets.max('LastEdited'), $SidebarWidgets.Count, $LastEdited, $Parent.LastEdited, $Parent.ID, $ID %>
  <% if not $HideSidebar %>
    <aside class="page__sidebar">
      <% loop $SidebarWidgets.Sort('SortOrder') %>
        <div class="sidebar__widget sidaber__widget--$ClassName.Lowercase">
          <% if $ShowTitle %>
            <strong class="widget__title">
              <% if $Title == '[title]' %>
                $Top.MenuTitle
              <% else %>
                $Title
              <% end_if %>
            </strong>
          <% end_if %>
          $WidgetLayout
        </div>
      <% end_loop %>
    </aside>
  <% end_if %>
<% end_cached %>