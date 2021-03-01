<template>
  <Layout>
    <div class="container">
      <div class="row">
        <div class="col-md-12 mt-4">
          <h1>Package</h1>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <div class="row">
                <div class="col-md-5">
                  <h5 class="float-left mt-2">List of package</h5>
                </div>
                <div class="col-md-7">
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
            </div>
            <div class="ex1">
              <div class="card-body">
                <div v-if="!packages.data.length">
                  <center>
                    <span>No matching records found</span>
                  </center>
                </div>
                <div class="row" v-for="data in packages.data" :key="data.id">
                  <inertia-link
                    preserve-scroll
                    class="col-md-1 float-left"
                    :href="$route('package.delete', { package: data.id })"
                    as="button"
                    method="DELETE"
                  >
                    <div>
                      <span class="float-left">
                        <svg
                          width="20px"
                          height="20px"
                          xmlns="http://www.w3.org/2000/svg"
                          fill="none"
                          viewBox="0 0 24 24"
                          stroke="red"
                        >
                          <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                          />
                        </svg>
                      </span>
                    </div>
                  </inertia-link>
                  <inertia-link
                    class="col-md-11"
                    :href="$route('package.view', { package: data })"
                  >
                    {{ data.name }} ({{ data.days }} days)
                    <span class="font-weight-bold float-right">
                      Php: {{ data.amount }}</span
                    >
                    <hr />
                  </inertia-link>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card">
            <div class="card-header"><h5>Add new package</h5></div>

            <div class="card-body">
              <form @submit.prevent="handleSubmit()">
                <div class="form-group">
                  <label for="name">Name</label>
                  <input
                    type="text"
                    class="form-control"
                    placeholder="Enter your package name"
                    id="name"
                    v-model="form.name"
                    tabindex="1"
                    :class="{ 'is-invalid': errors.name }"
                  />
                </div>
                <div class="form-group">
                  <label for="amount">Amount</label>
                  <input
                    type="text"
                    class="form-control"
                    placeholder="0"
                    id="amount"
                    v-model="form.amount"
                    tabindex="2"
                    :class="{ 'is-invalid': errors.amount }"
                  />
                </div>
                <div class="form-group">
                  <label for="days">No.of days</label>
                  <input
                    type="text"
                    class="form-control"
                    placeholder="0"
                    id="days"
                    v-model="form.days"
                    tabindex="3"
                    :class="{ 'is-invalid': errors.days }"
                  />
                </div>
                <button class="btn btn-success" tabindex="4">Submit</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </Layout>
</template>

<script>
export default {
  props: { packages: Object, errors: Object },
  data() {
    return {
      search: "",
      form: {
        name: "",
        amount: "",
        days: "",
      },
    };
  },
  methods: {
    handleSubmit() {
      this.$inertia.post("/package/save", this.form, {
        onSuccess: () => {
          this.form.name = "";
          this.form.amount = "";
          this.form.days = "";
        },
      });
    },
    searchit: _.throttle(function () {
      this.$inertia.get(
        "/package/list",
        { search: this.search },
        { preserveState: true },
        { preserveScroll: true }
      );
    }, 1000),
  },
  mounted() {},
};
</script>
<style>
.ex1 {
  height: auto;
  overflow-y: auto;
}
</style>
