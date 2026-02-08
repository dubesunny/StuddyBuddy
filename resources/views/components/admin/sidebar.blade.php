  <nav class="sidebar sidebar-offcanvas" id="sidebar">
      <ul class="nav">
          <li class="nav-item nav-profile">
              <a href="#" class="nav-link">
                  <div class="nav-profile-image">
                      <img src="{{ asset('admin/dist/assets/images/faces/face1.jpg') }}" alt="profile" />
                      <span class="login-status online"></span>
                      <!--change to offline or busy as needed-->
                  </div>
                  <div class="nav-profile-text d-flex flex-column">
                      <span class="font-weight-bold mb-2">David Grey. H</span>
                      <span class="text-secondary text-small">Project Manager</span>
                  </div>
                  <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
              </a>
          </li>



          <x-sidebar.item :route="route('dashboard')" icon="home" name="Dashboard" />
          @can('view_user')
              <x-sidebar.item :route="route('users.index')" icon="account-group" name="Users" />
          @endcan
          @can('view_course')
              <x-sidebar.item :route="route('courses.index')" icon="book-open-variant" name="Courses" />
          @endcan
      </ul>
  </nav>
