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
              <h4>Add Note</h4>
            </div>
            <div class="card-body">
              <form @submit.prevent="handleSubmit()">
                <div class="form-group">
                  <label for="note">Note</label>
                  <textarea
                    name="reminder"
                    id="reminder"
                    class="form-control"
                    :class="{ 'is-invalid': errors.note }"
                    v-model="form.note"
                    :disabled="reminder.status === 'completed'"
                  />
                </div>
                <button
                  class="btn btn-outline-danger"
                  :disabled="reminder.status === 'completed'"
                >
                  Close Reminder
                </button>
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
    reminder: Object,
    errors: Object,
  },
  data() {
    return {
      form: {
        note: "",
        reminder_id: this.reminder.id,
        lead_id: this.lead.id,
      },
    };
  },
  methods: {
    handleSubmit() {
      this.$inertia.post("/leads/view/reminder/close", this.form);
    },
  },
  mounted() {
    this.form.note = this.reminder.note;
  },
};
</script>
