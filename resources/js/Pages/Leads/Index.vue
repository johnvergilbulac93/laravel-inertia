<template>
  <Layout>
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <inertia-link class="btn btn-primary my-2 float-left" :href="$route('lead.add')"
            ><i class="fas fa-plus"></i>
          </inertia-link>
        </div>
        <div class="col-md-6 my-2">
          <input
            type="text"
            placeholder="Search"
            tabindex="1"
            name="search"
            id="search"
            v-model="search"
            @keyup="searchit"
            class="form-control"
          />
        </div>
      </div>

      <div class="table-responsive">
        <table class="table table-bordered">
          <thead class="font-weight-lighter">
            <tr class="bg-primary text-white">
              <th>
                <div class="form-check">
                  <input type="checkbox" class="form-check-input" />
                </div>
              </th>
              <th>ID</th>
              <th>Name</th>
              <th>Phone</th>
              <th>Email</th>
              <th>Birthday</th>
              <th>Age</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <tr v-if="!leads.data.length">
              <td colspan="7" class="text-center">No matching records found</td>
            </tr>
            <tr v-for="lead in leads.data" :key="lead.id">
              <td>
                <div class="form-check">
                  <input
                    type="checkbox"
                    class="form-check-input"
                    id=""
                    :value="lead.id"
                  />
                </div>
              </td>
              <td>{{ lead.id }}</td>
              <td>{{ lead.name | textformat }}</td>
              <td>{{ lead.phone }}</td>
              <td>{{ lead.email }}</td>
              <td>{{ lead.dob | dateformat }}</td>
              <td>{{ lead.age }}</td>
              <td class="text-center">
                <inertia-link :href="$route('lead.view', { lead: lead })"
                  ><i class="right fas fa-angle-right"></i
                ></inertia-link>
              </td>
            </tr>
            <tr>
              <td colspan="7" class="bg-primary text-white">
                <span class="display-6 font-weight-lighter"
                  >Showing Total Entries: {{ leads.total }}
                </span>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="float-right">
            <nav aria-label="Page navigation example ">
              <ul class="pagination">
                <li class="page-item">
                  <inertia-link
                    class="btn btn-primary"
                    :href="leads.prev_page_url"
                    v-if="leads.prev_page_url != null"
                    ><i class="right fas fa-angle-left"></i
                  ></inertia-link>
                </li>

                <li class="page-item ml-1">
                  <inertia-link
                    class="btn btn-primary"
                    :href="leads.next_page_url"
                    v-if="leads.next_page_url != null"
                    ><i class="right fas fa-angle-right"></i
                  ></inertia-link>
                </li>
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </Layout>
</template>

<script>
import _ from "lodash";
export default {
  props: { leads: Object },
  data() {
    return {
      search: "",
    };
  },
  methods: {
    searchit: _.throttle(function () {
      this.$inertia.get(
        "/leads/list",
        { search: this.search },
        { preserveState: true },
        { preserveScroll: true }
      );
    }, 1000),
  },
  mounted() {},
};
</script>
