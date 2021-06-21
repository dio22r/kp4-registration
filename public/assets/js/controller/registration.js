var registration = new Vue({
  el: "#data-vue",

  data: {
    alert_show: false,
    alert_msg: "test alert msg",
    data_peserta: {},
  },

  methods: {
    save: function (e) {
      let aliasForm = {
        nama: "form_nama",
        alamat: "form_alamat",
        kontak: "form_kontak",
      };

      e.preventDefault();
      that = this;

      let form = document.getElementById("form-data");
      let formData = new FormData(form);
      let url = form.getAttribute("action");

      axios.post(url, formData).then((response) => {
        if (response.data.status) {
          that.alert_show = false;
          that.alert_msg = response.data.msg;
          that.data_peserta = response.data.arrData;
          that.show_modal();
        } else {
          that.alert_show = true;
          that.alert_msg = response.data.msg;
        }
      });
    },

    show_modal: function () {
      let modal = document.getElementsByClassName("modal")[0];
      // modal.classList.add("animate__fadeIn");
      modal.style.display = "block";
    },
  },
});
