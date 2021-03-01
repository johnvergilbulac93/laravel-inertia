<template>
  <Layout>
    <div class="container">
      <div class="row">
        <div class="col-md-12 mt-4">
          <inertia-link class="btn btn-primary" :href="$route('package.list')"
            ><i class="right fas fa-angle-left"></i
          ></inertia-link>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6 mt-1">
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
                <button class="btn btn-success">Submit</button>
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
  props: {
    packages: Object,
    errors: Object,
  },
  data() {
    return {
      form: {
        name: "",
        amount: "",
        days: "",
      },
    };
  },
  methods: {
    handleSubmit() {
      this.$inertia.post("/package/update", this.form);
    },
  },
  mounted() {
    this.form = this.packages;
  },
};
</script>
