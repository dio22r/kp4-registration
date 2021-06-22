var app = new Vue({
  el: "#app-vue",
  data: {
    scanner: null,
    activeCameraId: null,
    cameras: [],
    scans: [],

    items: [],
    current_page: 1,
    total_page: 1,
    count_start: 1,
    retrieve_process: false,
    perpage: 20,

    total_data: 0,

    detail: false,
  },

  mounted: function () {
    var self = this;
    this.get_all();

    self.scanner = new Instascan.Scanner({
      video: document.getElementById("preview"),
      scanPeriod: 5,
    });
    self.scanner.addListener("scan", function (content, image) {
      self.getSubmitData(content);
    });
    Instascan.Camera.getCameras()
      .then(function (cameras) {
        self.cameras = cameras;
        if (cameras.length > 0) {
          self.activeCameraId = cameras[0].id;
          self.scanner.start(cameras[0]);
        } else {
          console.error("No cameras found.");
        }
      })
      .catch(function (e) {
        console.error(e);
      });
  },

  methods: {
    selectCamera: function (camera) {
      this.activeCameraId = camera.id;
      this.scanner.start(camera);
    },

    getSubmitData: function (content) {
      let self = this;

      axios.post("/admin/cek-tiket/" + content).then((response) => {
        self.detail = response.data;
        console.log(self.detail);
        if (response.data.status) {
          self.get_all();
        }
      });
    },

    get_all: function () {
      let that = this;

      let url = "/admin/cek-tiket/data";

      let datasend = {
        params: {
          page: this.current_page,
          limit: this.perpage,
          search: this.search,
        },
      };

      axios.get(url, datasend).then((response) => {
        that.items = response.data.data;
        that.total_page = response.data.totalpage;
        that.total_data = response.data.total;
        that.count_start = (that.current_page - 1) * that.perpage + 1;
      });
    },

    pagination: function (pagejump, event) {
      event.preventDefault();
      if (
        this.current_page + pagejump >= 1 &&
        this.current_page + pagejump <= this.total_page
      ) {
        this.current_page = this.current_page + pagejump;
        this.get_all();
      }
    },
  },
});
