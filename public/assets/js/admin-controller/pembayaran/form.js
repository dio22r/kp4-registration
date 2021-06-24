var auth_login = new Vue({
  el: "#data-vue",

  data: {
    table_peserta: [],

    data_peserta: [],

    total_tagihan: 0,

    m_peserta: false,
    m_keterangan: "",
    m_jumlah_bayar: "500000",
  },

  methods: {
    add_peserta: function () {
      if (this.m_peserta) {
        let self = this;
        let selData = this.data_peserta.filter(function (el) {
          return el.id == self.m_peserta;
        });

        if (selData) {
          if (!this.table_peserta.includes(selData[0])) {
            this.table_peserta.push(selData[0]);
          } else {
            alert("data sudah ada");
          }
        }
        this.sum_tagihan();
      }
    },

    remove_data: function (id) {
      this.table_peserta = this.table_peserta.filter(function (el) {
        return el.id != id;
      });
      this.sum_tagihan();
    },

    sum_tagihan: function () {
      this.total_tagihan = 0;
      for (const key in this.table_peserta) {
        this.total_tagihan += parseInt(this.table_peserta[key].total_tagihan);
      }
    },

    click_bayar: function (e) {
      e.preventDefault();

      let arr_error = [];

      if (this.m_keterangan.trim() == "") {
        arr_error.push("Keterangan harus di isi.");
      }

      if (!parseInt(this.m_jumlah_bayar)) {
        arr_error.push("Jumlah bayar harus di isi angka");
      }

      if (this.table_peserta.length < 1) {
        arr_error.push("Peserta belum dipilih");
      }

      if (arr_error.length == 0) {
        let conf = confirm("Anda yakin akan menyimpan data ini?");

        let url = base_config.api_url;
        if (conf) {
          let form = document.getElementById("form");
          console.log(form);
          let formData = new FormData(form);

          this.table_peserta.forEach((el, index) => {
            formData.append(`peserta[${index}]`, el.id);
          });

          axios.post(url, formData).then((response) => {
            if (response.data.status) {
              alert("data berhasil tersimpan");
              window.location = "/admin/pembayaran/detail/" + response.data.id;
            }
          });
        }
      }
    },
  },

  mounted: function () {
    let self = this;

    let datasend = {
      params: {
        page: 1,
        limit: 999,
        search: "",
        status_lunas: 0,
      },
    };

    let url = "/admin/peserta";
    axios.get(url, datasend).then((response) => {
      self.data_peserta = response.data.data;

      if (base_config.idPeserta !== false) {
        this.m_peserta = base_config.idPeserta;
        this.add_peserta();
        let selData = this.data_peserta.filter(function (el) {
          return el.id == self.m_peserta;
        });

        this.m_keterangan = "Lunas a/n " + selData[0]["nama"];
      }
    });
  },
});
