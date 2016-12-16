<% if $SidebarWidgets %>
  <aside class="page__sidebar">
    <% loop $SidebarWidgets.Sort(SortOrder) %>
      <div class="sidebar-widget sidaber-widget--$ClassName.Lowercase">
        <% if $ShowTitle %>
          <strong class="sidebar-widget__title">
            <% if $Title == [title] %>
              <% if $ExtraContent == navigation %>
                $Top.Parent.MenuTitle
              <% else %>
                $Top.MenuTitle
              <% end_if %>
            <% else %>
              $Title
            <% end_if %>
          </strong>
        <% end_if %>
        <% if $ExtraContent == navigation %>
          <% include SidebarWidget_Navigation Page=$Top %>
        <% else_if $ExtraContent == contact %>
          <% include GlobalContactDetails HideAddress=true, ExtraCacheParameter=$ID %>
        <% else_if $ExtraContent == address %>
          <% include GlobalContactDetails HideContact=true, ExtraCacheParameter=$ID %>
        <% else_if $ExtraContent == socialmedia %>
          <% include GlobalSocialMedia %>
        <% else %>
          $WidgetLayout
        <% end_if %>
      </div>
    <% end_loop %>
  </aside>
<% end_if %>