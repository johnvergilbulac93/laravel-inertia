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
              <div class="card-header">
                <h4>Lead Details</h4>
              </div>
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
                      />
                    </div>
                    <div class="form-group">
                      <label for="package">Interested Package</label>

                      <select
                        name="package"
                        id="package"
                        v-model="form.package"
                        tabindex="5"
                        class="form-control"
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
                      />
                    </div>
                    <div class="form-group">
                      <label for="dob">Birthday</label>
                      <input
                        type="date"
                        class="form-control"
                        placeholder="Enter your birthday"
                        v-model="form.dob"
                        id="name"
                        tabindex="4"
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
      <div class="row">
        <div class="col-md-12 my-2">
          <div class="card" v-if="leadProp.reminders.length > 0">
            <div class="card-header">
              <div class="row">
                <div class="col-md-6"><h4>Lead Reminders</h4></div>
                <div class="col-md-6">
                  <inertia-link
                    class="btn btn-success float-right"
                    :href="$route('reminder.add', { lead: leadProp })"
                  >
                    Add new reminder
                  </inertia-link>
                </div>
              </div>
            </div>
            <div class="card-body">
              <ul class="list-group list-group-flush">
                <li
                  class="list-group-item list-group-item-action"
                  v-for="reminder in leadProp.reminders"
                  :key="reminder.id"
                >
                  <div class="row">
                    <div class="col-md-6">{{ reminder.reminder }}</div>
                    <div class="col-md-2">{{ reminder.reminder_date }}</div>
                    <div class="col-md-2">
                      <span :class="`badge reminder ${reminder.status}`"
                        >{{ reminder.status | textformat }}
                      </span>
                    </div>
                    <div class="col-md-2">
                      <inertia-link
                        :href="
                          $route('reminder.view', { lead: leadProp, reminder: reminder })
                        "
                        ><i class="right fas fa-angle-right"></i>
                      </inertia-link>
                    </div>
                  </div>
                </li>
              </ul>
            </div>
          </div>
          <div class="card" v-else>
            <div class="card-header"><h4>Lead Reminders</h4></div>
            <div class="card-body">
              <inertia-link
                class="btn btn-success"
                :href="$route('reminder.add', { lead: leadProp })"
                >Add new reminder</inertia-link
              >
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
    leadProp: Object,
    packages: Array,
  },
  data() {
    return {
      form: {
        name: "",
        email: "",
        phone: "",
        dob: "",
        package: "",
      },
    };
  },
  methods: {
    handleSubmit() {
      this.$inertia.post("/leads/update", this.form, {
        onSuccess: () => {
          swal.fire("Lead successfully", "Updated", "success");
        },
      });
    },
  },
  mounted() {
    this.form = this.leadProp;
  },
};
</script>
