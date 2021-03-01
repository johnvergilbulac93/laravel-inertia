<template>
  <Layout>
    <div class="container">
      <div class="row">
        <div class="col-md-12 my-1">
          <inertia-link
            class="btn btn-primary float-right"
            :href="$route('lead.view', { lead: lead })"
            ><i class="right fas fa-angle-left"></i
          ></inertia-link>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <h4>Add Reminder</h4>
            </div>

            <div class="card-body">
              <form @submit.prevent="handleSubmit()">
                <div class="form-group">
                  <label for="reminder">Reminder</label>
                  <textarea
                    name="reminder"
                    id="reminder"
                    class="form-control"
                    :class="{ 'is-invalid': errors.reminder }"
                    v-model="form.reminder"
                  />
                </div>
                <div class="form-group">
                  <label for="date">Reminder Date</label>
                  <input
                    type="date"
                    name="date"
                    id="date"
                    class="form-control"
                    :class="{ 'is-invalid': errors.reminder_date }"
                    v-model="form.reminder_date"
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
    lead: Object,
    errors: Object,
  },
  data() {
    return {
      form: {
        reminder: "",
        reminder_date: "",
        lead_id: this.lead.id,
      },
    };
  },
  methods: {
    handleSubmit() {
      this.$inertia.post("/leads/view/reminder/save", this.form);
    },
  },
};
</script>
