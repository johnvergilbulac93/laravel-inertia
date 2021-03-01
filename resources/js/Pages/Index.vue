<template>
  <Layout>
    <div class="container" v-if="$page.props.user.can.isAdmin">
      <div class="row">
        <div class="col-md-4 mt-2">
          <div class="card">
            <div class="card-header">
              <h4>TO DO Reminders</h4>
            </div>

            <div class="card-body">
              <ul class="list-group list-group-flush">
                <li
                  class="list-group-item"
                  v-for="reminder in reminders"
                  :key="reminder.id"
                >
                  <div class="blockquote">
                    {{ reminder.reminder }}
                  </div>

                  <br />

                  <inertia-link
                    :href="
                      $route('lead.view', { lead: reminder.lead, reminder: reminder })
                    "
                    ><div class="blockquote-footer">
                      <strong>{{ reminder.lead.name }}</strong>
                    </div>
                  </inertia-link>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </Layout>
</template>

<script>
export default {
  props: ["reminders"],
};
</script>
