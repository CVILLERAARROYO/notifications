<template>
  <div>
    <h2>Notificaciones en tiempo real</h2>
    <pre>
    {{ notifications }}

    </pre>
    <li v-for="notification in notifications" :key="notification.id">
      {{ notification.message }}
    </li>
    <pre>
    {{ $page.props.notifications }}
    </pre>
  </div>
</template>
<script>
import Pusher from "pusher-js";

export default {
  data() {
    return {
      notifications: [],
    };
  },
  mounted() {
    Pusher.logToConsole = true;
    const pusher = new Pusher("9cf2d22dfcf25aee5b8d", {
      cluster: "us2",
    });
    const channel = pusher.subscribe("my-channel");
    channel.bind("my-event", (data) => {
      console.log(data);
      this.notifications.push(data);
    });
  },
};
</script>
