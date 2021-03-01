<template>
  <div>
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
      <div class="container">
        <inertia-link class="navbar-brand" href="/dashboard">FitApp </inertia-link>
        <button
          class="navbar-toggler"
          type="button"
          data-toggle="collapse"
          data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="#"
        >
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Left Side Of Navbar -->
          <ul class="navbar-nav mr-auto">
            <li class="nav-item dropdown">
              <a
                id="navbarDropdown"
                class="nav-link dropdown-toggle"
                role="button"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
              >
                Manage
              </a>

              <div
                class="dropdown-menu dropdown-menu-right"
                aria-labelledby="navbarDropdown"
              >
                <inertia-link class="dropdown-item" href="/leads/list"
                  >Leads
                </inertia-link>
                <inertia-link class="dropdown-item" href="/package/list"
                  >Packages
                </inertia-link>
              </div>
            </li>
          </ul>

          <!-- Right Side Of Navbar -->
          <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
              <a
                id="navbarDropdown"
                class="nav-link dropdown-toggle"
                role="button"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
              >
                {{ $page.props.user.name }}
              </a>

              <div
                class="dropdown-menu dropdown-menu-right"
                aria-labelledby="navbarDropdown"
              >
                <a class="dropdown-item" @click="logout">Logout </a>
                <!-- <inertia-link href="$route('/logout')">Logout</inertia-link> -->
              </div>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <main class="py-1">
      <slot />
    </main>
  </div>
</template>
<script>
export default {
  data() {
    return {
      name: null,
    };
  },
  methods: {
    async logout() {
      await axios.post("/logout");
      window.location.href = "/";
    },
  },
};
</script>
