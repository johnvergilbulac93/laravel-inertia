<template>
  <Layout>
    <div class="container">
      <div class="row">
        <div class="col-md-12 my-1">
          <inertia-link class="btn btn-primary float-right" :href="$route('lead.list')"
            ><i class="right fas fa-angle-left"></i
          ></inertia-link>
        </div>
      </div>
      <form @submit.prevent="handleSubmit()">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="name">Name</label>
                      <input
                        type="text"
                        class="form-control"
                        placeholder="Enter your name"
                        v-model="form.name"
                        id="name"
                        tabindex="1"
                        :class="{ 'is-invalid': errors.name }"
                      />
                    </div>
                    <div class="form-group">
                      <label for="phone">Phone</label>
                      <input
                        type="text"
                        class="form-control"
                        placeholder="Enter your phone number"
                        v-model="form.phone"
                        id="name"
                        tabindex="3"
                        :class="{ 'is-invalid': errors.phone }"
                      />
                    </div>
                    <div class="form-group">
                      <label for="package">Interested Package</label>
                      <!-- <input
                        type="text"
                        class="form-control"
                        placeholder="Enter your package interested in"
                        v-model="form.package"
                        id="name"
                        tabindex="5"
                        :class="{ 'is-invalid': errors.package }"
                      /> -->
                      <select
                        name="package"
                        id="package"
                        v-model="form.package"
                        tabindex="5"
                        class="form-control"
                        :class="{ 'is-invalid': errors.package }"
                      >
                        <option :value="data.id" v-for="data in packages" :key="data.id">
                          {{ data.name }}
                        </option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="email">Email Address</label>
                      <input
                        type="email"
                        class="form-control"
                        placeholder="Enter your email address"
                        v-model="form.email"
                        id="name"
                        tabindex="2"
                        :class="{ 'is-invalid': errors.email }"
                      />
                    </div>
                    <div class="form-group">
                      <label for="dob">Birthday</label>
                      <input
                        type="date"
                        class="form-control"
                        placeholder="Enter your birthday"
                        v-model="form.birthday"
                        id="name"
                        tabindex="4"
                        :class="{ 'is-invalid': errors.birthday }"
                      />
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <button class="btn btn-success" tabindex="6">Submit</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </Layout>
</template>

<script>
export default {
  props: {
    packages: Array,
    errors: Object,
  },
  data() {
    return {
      form: {
        name: "",
        email: "",
        phone: "",
        birthday: "",
        package: "",
      },
    };
  },
  methods: {
    handleSubmit() {
      this.$inertia.post("/leads/save", this.form);
    },
  },
};
</script>
