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
              <h4>Reminder Details</h4>
            </div>

            <div class="card-body">
              <form>
                <div class="form-group">
                  <label for="reminder">Reminder</label>
                  <textarea
                    name="reminder"
                    id="reminder"
                    class="form-control"
                    v-model="form.reminder"
                    tabindex="1"
                  />
                </div>
                <div class="form-group">
                  <label for="date">Reminder Date</label>
                  <input
                    type="date"
                    name="date"
                    id="date"
                    class="form-control"
                    v-model="form.reminder_date"
                    tabindex="2"
                  />
                </div>
                <inertia-link
                  class="btn btn-outline-danger"
                  :href="$route('reminder.note', { lead: lead, reminder: reminder })"
                  tabindex="3"
                >
                  Close Reminder</inertia-link
                >
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
  },
  data() {
    return {
      form: {
        reminder: "",
        reminder_date: "",
      },
    };
  },
  mounted() {
    this.form = this.reminder;
  },
};
</script>
