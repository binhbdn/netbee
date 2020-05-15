<template>

  <div>
    <!--section login-->
    <section class="ftco-section services-section card" style="background: #fff" v-if="!$auth.loggedIn">
      <div class="container">
        <div class="row " style="padding-left:14px!important;">
          <div class="col-md-2  align-self-stretch ftco-animate" style="padding-left:0!important;">
            <div class="d_item v_block">
              <a class="media block-6 services d-block" href="dang-ky">
                <div class="icon text-center SB_bn">
                  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                        id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512"
                        style="enable-background:new 0 0 512 512; width: 47px; height: 65px; padding-top: 5px; padding-bottom: 10px;"
                        xml:space="preserve"><g><g>
                      <path d="M414.007,148.75c5.522,0,10-4.477,10-10V30c0-16.542-13.458-30-30-30h-364c-16.542,0-30,13.458-30,30v452    c0,16.542,13.458,30,30,30h364c16.542,0,30-13.458,30-30v-73.672c0-5.523-4.478-10-10-10c-5.522,0-10,4.477-10,10V482    c0,5.514-4.486,10-10,10h-364c-5.514,0-10-4.486-10-10V30c0-5.514,4.486-10,10-10h364c5.514,0,10,4.486,10,10v108.75    C404.007,144.273,408.485,148.75,414.007,148.75z"/></g></g><g><g>
                      <path d="M212.007,54c-50.729,0-92,41.271-92,92c0,26.317,11.11,50.085,28.882,66.869c0.333,0.356,0.687,0.693,1.074,1    c16.371,14.979,38.158,24.13,62.043,24.13c23.885,0,45.672-9.152,62.043-24.13c0.387-0.307,0.741-0.645,1.074-1    c17.774-16.784,28.884-40.552,28.884-66.869C304.007,95.271,262.736,54,212.007,54z M212.007,218    c-16.329,0-31.399-5.472-43.491-14.668c8.789-15.585,25.19-25.332,43.491-25.332c18.301,0,34.702,9.747,43.491,25.332    C243.405,212.528,228.336,218,212.007,218z M196.007,142v-6.5c0-8.822,7.178-16,16-16s16,7.178,16,16v6.5c0,8.822-7.178,16-16,16    S196.007,150.822,196.007,142z M269.947,188.683c-7.375-10.938-17.596-19.445-29.463-24.697c4.71-6.087,7.523-13.712,7.523-21.986    v-6.5c0-19.851-16.149-36-36-36s-36,16.149-36,36v6.5c0,8.274,2.813,15.899,7.523,21.986    c-11.867,5.252-22.088,13.759-29.463,24.697c-8.829-11.953-14.06-26.716-14.06-42.683c0-39.701,32.299-72,72-72s72,32.299,72,72    C284.007,161.967,278.776,176.73,269.947,188.683z"/></g></g><g><g>
                      <path d="M266.007,438h-54c-5.522,0-10,4.477-10,10s4.478,10,10,10h54c5.522,0,10-4.477,10-10S271.529,438,266.007,438z"/></g></g><g><g>
                      <path d="M266.007,382h-142c-5.522,0-10,4.477-10,10s4.478,10,10,10h142c5.522,0,10-4.477,10-10S271.529,382,266.007,382z"/></g></g><g><g>
                      <path d="M266.007,326h-142c-5.522,0-10,4.477-10,10s4.478,10,10,10h142c5.522,0,10-4.477,10-10S271.529,326,266.007,326z"/></g></g><g><g>
                      <path d="M88.366,272.93c-1.859-1.86-4.439-2.93-7.079-2.93c-2.631,0-5.211,1.07-7.07,2.93c-1.86,1.86-2.93,4.44-2.93,7.07    s1.069,5.21,2.93,7.07c1.87,1.86,4.439,2.93,7.07,2.93c2.64,0,5.21-1.07,7.079-2.93c1.86-1.86,2.931-4.44,2.931-7.07    S90.227,274.79,88.366,272.93z"/></g></g><g><g>
                      <path d="M88.366,328.93c-1.869-1.86-4.439-2.93-7.079-2.93c-2.631,0-5.2,1.07-7.07,2.93c-1.86,1.86-2.93,4.44-2.93,7.07    s1.069,5.21,2.93,7.07c1.87,1.86,4.439,2.93,7.07,2.93c2.64,0,5.21-1.07,7.079-2.93c1.86-1.86,2.931-4.44,2.931-7.07    S90.227,330.79,88.366,328.93z"/></g></g><g><g>
                      <path d="M88.366,384.93c-1.869-1.86-4.439-2.93-7.079-2.93c-2.631,0-5.2,1.07-7.07,2.93c-1.86,1.86-2.93,4.44-2.93,7.07    s1.069,5.21,2.93,7.07c1.859,1.86,4.439,2.93,7.07,2.93c2.64,0,5.22-1.07,7.079-2.93c1.86-1.86,2.931-4.44,2.931-7.07    S90.227,386.79,88.366,384.93z"/></g></g><g><g>
                      <path d="M266.007,270h-142c-5.522,0-10,4.477-10,10s4.478,10,10,10h142c5.522,0,10-4.477,10-10S271.529,270,266.007,270z"/></g></g><g><g>
                      <path d="M491.002,130.32c-9.715-5.609-21.033-7.099-31.871-4.196c-10.836,2.904-19.894,9.854-25.502,19.569L307.787,363.656    c-0.689,1.195-1.125,2.52-1.278,3.891l-8.858,79.344c-0.44,3.948,1.498,7.783,4.938,9.77c1.553,0.896,3.278,1.34,4.999,1.34    c2.092,0,4.176-0.655,5.931-1.948l64.284-47.344c1.111-0.818,2.041-1.857,2.73-3.052l125.841-217.963    C517.954,167.638,511.058,141.9,491.002,130.32z M320.063,426.394l4.626-41.432l28.942,16.71L320.063,426.394z M368.213,386.996    l-38.105-22l100.985-174.91l38.105,22L368.213,386.996z M489.054,177.693l-9.857,17.073l-38.105-22l9.857-17.073    c2.938-5.089,7.682-8.729,13.358-10.25c5.678-1.522,11.606-0.74,16.694,2.198c5.089,2.938,8.729,7.682,10.25,13.358    C492.772,166.675,491.992,172.604,489.054,177.693z"/></g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g>
                  </svg>
                </div>
                <div class="media-body">
                  <h3 class="heading mb-3 text-center text-12">Đăng ký</h3>
                </div>
              </a>
            </div>
          </div>
          <div class="col-md-2  align-self-stretch ftco-animate">
            <div class="d_item v_block">
              <a class="media block-6 services d-block" href="dang-nhap">
                <div class="icon text-center SB_bn">
                  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                        id="Layer_1" x="0px" y="0px" viewBox="0 0 512 512"
                        style="enable-background:new 0 0 512 512;width: 47px; height: 65px; padding-top: 5px; padding-bottom: 10px;" xml:space="preserve"><g><g>
                      <path d="M260.276,222.33c-32.711,0-59.324,26.612-59.324,59.324s26.612,59.324,59.324,59.324s59.324-26.612,59.324-59.324    S292.987,222.33,260.276,222.33z M260.276,324.944c-23.871,0-43.29-19.42-43.29-43.29s19.42-43.29,43.29-43.29    s43.29,19.42,43.29,43.29S284.146,324.944,260.276,324.944z"/></g></g><g><g>
                      <path d="M414.196,0c-32.711,0-59.324,26.612-59.324,59.324c0,32.711,26.612,59.324,59.324,59.324    c32.711,0,59.324-26.612,59.324-59.324C473.52,26.612,446.908,0,414.196,0z M414.196,102.614c-23.87,0-43.29-19.42-43.29-43.29    s19.42-43.29,43.29-43.29c23.871,0,43.29,19.42,43.29,43.29S438.067,102.614,414.196,102.614z"/></g></g><g><g>
                      <path d="M97.804,0C65.092,0,38.48,26.612,38.48,59.324c0,32.711,26.612,59.324,59.324,59.324    c32.711,0,59.324-26.612,59.324-59.324C157.127,26.612,130.515,0,97.804,0z M97.804,102.614c-23.871,0-43.29-19.42-43.29-43.29    s19.42-43.29,43.29-43.29s43.29,19.42,43.29,43.29S121.674,102.614,97.804,102.614z"/></g></g><g><g>
                      <path d="M491.157,195.608c4.428,0,8.017-3.589,8.017-8.017v-25.653c0-23.281-18.941-42.221-42.221-42.221H371.44    c-2.606,0-5.198,0.267-7.756,0.746c-29.559-22.564-66.121-34.951-103.409-34.951c-38.311,0-75.605,12.983-105.582,36.644    c-4.519-1.615-9.251-2.439-14.134-2.439H55.048c-23.281,0-42.221,18.941-42.221,42.221v119.716c0,4.427,3.588,8.017,8.017,8.017    h72.281c3.295,16.457,8.992,32.27,16.979,47.095c2.212,4.103,7.615,5.444,11.5,2.87c3.405-2.258,4.55-6.883,2.616-10.475    c-6.722-12.475-11.652-25.721-14.709-39.489h65.254c4.428,0,8.017-3.589,8.017-8.017V161.938c0-11.925-4.937-22.977-13.365-30.833    c26.287-19.127,58.165-29.56,90.86-29.56c31.217,0,60.795,9.066,86.282,26.33c-10.623,7.815-17.339,20.413-17.339,34.062v119.716    c0,4.427,3.588,8.017,8.017,8.017h73.793c-8.69,38.866-32.504,73.294-65.776,95.309v-0.712c0-23.28-18.941-42.221-42.221-42.221    H217.52c-23.281,0-42.221,18.941-42.221,42.221v0.721c-13.093-8.628-24.754-19.157-34.77-31.438    c-2.799-3.43-7.849-3.944-11.28-1.146c-3.431,2.798-3.943,7.848-1.146,11.279c13.255,16.253,29.118,29.733,47.196,40.136v100.164    c0,4.427,3.588,8.017,8.017,8.017h153.921c4.428,0,8.017-3.589,8.017-8.017V403.823c42.357-24.42,72.55-66.437,82.155-114.152    h63.749c4.428,0,8.017-3.589,8.017-8.017v-51.307c0-4.427-3.588-8.017-8.017-8.017c-4.428,0-8.017,3.589-8.017,8.017v43.29    H345.253V161.937c0-11.531,7.719-21.859,18.772-25.116h0.001c2.415-0.711,4.909-1.071,7.415-1.071h19.875l6.194,18.583    l-8.399,92.391c-0.299,3.287,1.447,6.421,4.397,7.896l17.102,8.551c2.237,1.118,4.934,1.118,7.171,0l17.102-8.551    c2.951-1.475,4.698-4.61,4.397-7.896l-8.399-92.391l6.195-18.584h19.875c14.441,0,26.188,11.748,26.188,26.188v25.653    C483.14,192.018,486.728,195.608,491.157,195.608z M103.784,135.749l-3.207,9.62h-5.546l-3.207-9.62H103.784z M96.573,161.403    h2.462l7.392,81.322l-8.623,4.312l-8.623-4.312L96.573,161.403z M166.747,273.637H28.86V161.937    c0-14.44,11.747-26.188,26.188-26.188h19.875l6.194,18.583l-8.399,92.391c-0.299,3.287,1.447,6.421,4.397,7.896l17.102,8.551    c2.237,1.118,4.934,1.118,7.171,0l17.102-8.551c2.951-1.475,4.698-4.61,4.397-7.896l-8.399-92.391l6.195-18.583h19.875    c4.147,0,8.122,0.948,11.812,2.819c8.868,4.494,14.376,13.448,14.376,23.369V273.637z M266.256,358.079l-3.207,9.62h-5.547    l-3.207-9.62H266.256z M259.045,383.733h2.462l7.392,81.323l-8.623,4.312l-8.623-4.312L259.045,383.733z M329.219,495.967H191.332    V384.267c0-14.44,11.747-26.188,26.188-26.188h19.875l6.194,18.583l-8.399,92.391c-0.299,3.287,1.447,6.421,4.397,7.896    l17.102,8.551c2.237,1.118,4.934,1.118,7.171,0l17.102-8.551c2.951-1.475,4.698-4.61,4.397-7.896l-8.399-92.391l6.195-18.583    h19.875c14.441,0,26.188,11.748,26.188,26.188V495.967z M420.177,135.749l-3.207,9.62h-5.547l-3.207-9.62H420.177z     M414.196,247.037l-8.623-4.312l7.392-81.322h2.462l7.392,81.322L414.196,247.037z"/></g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g>
                  </svg>
                </div>
                <div class="media-body">
                  <h3 class="heading mb-3 text-center text-12">Đăng nhập</h3>
                </div>
              </a>
            </div>
          </div>
          <div class="col-md-5  align-self-stretch ftco-animate" style="padding: 0 10px;">
            <div class="d_item v_block bg__" style="background-color: #ffb701">
              <a class="media block-6 services d-block" href="">
                <div class="icon text-center SB_bn">
                  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 512.039 512.039"
                        style="enable-background:new 0 0 512.039 512.039;width: 47px; height: 65px; padding-top: 5px; padding-bottom: 10px;" xml:space="preserve" width="512" height="512">
                    <g id="XMLID_1258_">
                      <g id="XMLID_1850_">
                        <path id="XMLID_1911_" d="M509.067,215.358c-2.367-2.366-5.766-3.391-9.044-2.732l-86.184,17.345    c-3.613,0.728-6.534,3.384-7.6,6.911c-1.066,3.528-0.105,7.357,2.501,9.964l11.66,11.66l-45.762,45.762l-35.426-35.426    c-1.876-1.875-4.419-2.929-7.071-2.929s-5.195,1.054-7.071,2.929L281.6,312.313l16.306-58.59    c3.964-14.243,1.108-29.163-7.835-40.936c-5.478-7.21-12.71-12.526-20.886-15.572l13.035-37.236    c3.597,0.316,7.185,0.477,10.732,0.477c28.876,0,57.03-10.178,79.277-28.657l2.383-1.979c11.729-9.745,13.733-26.68,4.565-38.552    c-4.649-6.021-11.367-9.797-18.917-10.631c-7.553-0.835-14.933,1.381-20.777,6.236l-2.707,2.249    c-3.989,3.313-8.351,6.174-12.965,8.501c-15.42,7.778-34.676,4.314-47.471-8.349c18.612-5.765,32.17-23.139,32.17-43.621    C308.511,20.48,288.03,0,262.856,0c-25.175,0-45.655,20.48-45.655,45.654c0,10.018,3.251,19.286,8.742,26.822    c-10.386,2.236-19.733,7.591-26.885,15.162c-0.417,0.366-0.817,0.762-1.179,1.208c-17.629,21.654-41.131,37.186-67.964,44.915    c-7.265,2.094-13.015,6.918-16.466,13.034l-20.496-20.496c-8.968-8.967-23.558-8.966-32.527,0l-26.823,26.824l0,0l0,0    L6.78,179.946c-4.345,4.344-6.737,10.119-6.737,16.264c0,6.144,2.393,11.919,6.736,16.264l73.905,73.905    c4.345,4.344,10.12,6.736,16.264,6.736c6.145,0,11.92-2.393,16.264-6.736l27.773-27.773l-13.169,34.532    c-1.968,5.16,0.62,10.939,5.78,12.907c1.173,0.447,2.377,0.659,3.562,0.659c4.028,0,7.825-2.452,9.346-6.439l32.798-86.001h62.61    h10.823c8.479,0,16.282,3.872,21.411,10.623s6.767,15.307,4.493,23.474l-22.723,81.646c-1.022,3.674-4.4,6.24-8.214,6.24    c-3.422,0-5.532-1.874-6.485-2.991s-2.473-3.496-1.936-6.874l12.091-76.012c0.46-2.891-0.37-5.837-2.27-8.063    c-1.9-2.226-4.68-3.508-7.606-3.508h-23.708c-3.771,0-7.222,2.121-8.924,5.486c-0.584,1.154-58.605,115.875-78.157,154.639    c-1.957,3.882-6.212,6.097-10.575,5.5l-0.474-0.064c-2.977-0.402-5.563-2.114-7.098-4.697s-1.8-5.674-0.729-8.48l6.162-16.157    c1.968-5.16-0.62-10.938-5.78-12.907c-5.159-1.968-10.938,0.621-12.907,5.78l-6.162,16.157    c-3.259,8.546-2.449,17.957,2.222,25.821c4.671,7.863,12.548,13.077,21.604,14.303l0.474,0.063    c1.371,0.187,2.737,0.276,4.094,0.276c11.322,0,21.852-6.326,27.027-16.588c17.078-33.86,63.524-125.706,75.372-149.132h5.843    l-10.25,64.441c-1.313,8.257,1.047,16.641,6.476,23c3.492,4.091,8.014,7.052,13.02,8.649L127.629,466.286    c-1.875,1.876-2.929,4.419-2.929,7.071s1.054,5.196,2.929,7.071l28.683,28.682c1.953,1.952,4.512,2.929,7.071,2.929    s5.118-0.977,7.071-2.929l55.141-55.141c3.905-3.905,3.905-10.237,0-14.143c-3.906-3.904-10.236-3.904-14.143,0l-48.069,48.07    l-14.54-14.54l183.3-183.302l35.426,35.426c1.876,1.875,4.419,2.929,7.071,2.929s5.195-1.054,7.071-2.929l59.903-59.904    c3.905-3.905,3.905-10.237,0-14.143l-5.538-5.538l53.149-10.696l-10.696,53.149l-8.231-8.231c-3.906-3.904-10.236-3.904-14.143,0    l-81.516,81.516l-35.426-35.426c-3.906-3.904-10.236-3.904-14.143,0l-57.051,57.051c-3.905,3.905-3.905,10.237,0,14.143    c3.906,3.904,10.236,3.904,14.143,0l49.979-49.979l35.426,35.426c3.906,3.904,10.236,3.904,14.143,0l81.516-81.516l14.354,14.354    c2.606,2.606,6.437,3.569,9.963,2.501c3.528-1.065,6.185-3.986,6.912-7.6l17.345-86.185    C512.46,221.121,511.434,217.726,509.067,215.358z M262.856,20c14.146,0,25.654,11.509,25.654,25.654    c0,14.146-11.509,25.655-25.654,25.655c-14.146,0-25.655-11.509-25.655-25.655C237.201,31.509,248.71,20,262.856,20z     M163.904,197.25l-12.17-12.17c5.78-1.886,11.457-4.043,17.015-6.456L163.904,197.25z M130.155,162.562    c-1.182-4.102,1.195-8.4,5.297-9.582c16.439-4.736,31.772-12.048,45.586-21.597l-5.647,21.71    c-11.242,6.212-23.211,11.18-35.657,14.765c-0.231,0.066-0.473,0.124-0.712,0.17c-1.845,0.351-3.691-0.016-5.241-0.9l-2.929-2.929    C130.563,163.688,130.323,163.144,130.155,162.562z M74.567,140.441c0.585-0.585,1.354-0.877,2.122-0.877s1.537,0.292,2.121,0.877    l36.452,36.452c1.691,2.309,3.707,4.322,5.978,5.978l31.476,31.476c1.17,1.169,1.17,3.073,0,4.242l-19.752,19.752l-21.967-21.967    l4.184-4.184c3.905-3.905,3.905-10.237,0-14.143l-22.51-22.51c-3.906-3.904-10.236-3.904-14.143,0l-4.184,4.184l-19.529-19.529    L74.567,140.441z M88.255,210.832c-0.957,0.957-2.074,1.101-2.655,1.101c-0.58,0-1.697-0.144-2.654-1.1v-0.001l-3.059-3.058    c-0.956-0.957-1.1-2.074-1.1-2.654c0-0.581,0.144-1.698,1.101-2.655l5.712-5.712l8.367,8.367L88.255,210.832z M99.069,272.237    c-0.727,0.726-1.554,0.878-2.121,0.878c-0.566,0-1.395-0.152-2.121-0.879l-73.905-73.905c-0.727-0.727-0.879-1.555-0.879-2.121    c0-0.567,0.152-1.395,0.879-2.121l19.751-19.752L61.137,194.8c-1.535,3.178-2.35,6.686-2.35,10.32    c0,6.346,2.472,12.311,6.958,16.797l3.058,3.057v0.001c4.486,4.486,10.452,6.958,16.797,6.958c3.634,0,7.142-0.814,10.32-2.35    l22.902,22.902L99.069,272.237z M241.911,194.264h-56.564l20.543-78.973c3.674-14.12,16.429-23.981,31.019-23.981    c9.013,0,17.35,3.634,23.475,10.233c18.788,20.244,48.577,25.975,72.436,13.938c5.958-3.005,11.59-6.696,16.738-10.974    l2.707-2.249c1.632-1.356,3.691-1.978,5.801-1.74c2.105,0.232,3.981,1.288,5.283,2.975c2.513,3.253,1.832,8.163-1.516,10.944    l-2.382,1.979c-18.664,15.504-42.28,24.042-66.498,24.042c-5.259,0-10.634-0.421-15.977-1.252    c-4.769-0.748-9.382,2.024-10.976,6.577l-16.972,48.481H241.911z"/>
                        <path id="XMLID_1920_" d="M246.996,408.8c-2.63,0-5.21,1.069-7.07,2.93c-1.86,1.859-2.93,4.439-2.93,7.07    c0,2.64,1.069,5.21,2.93,7.069c1.86,1.87,4.44,2.931,7.07,2.931s5.21-1.061,7.069-2.931c1.86-1.859,2.931-4.43,2.931-7.069    c0-2.631-1.07-5.211-2.931-7.07C252.206,409.869,249.626,408.8,246.996,408.8z"/>
                        <path id="XMLID_1921_" d="M122.886,344.14c2.63,0,5.21-1.07,7.07-2.931c1.859-1.859,2.93-4.439,2.93-7.069s-1.07-5.21-2.93-7.07    c-1.87-1.86-4.44-2.93-7.07-2.93s-5.21,1.069-7.08,2.93c-1.859,1.86-2.92,4.44-2.92,7.07s1.061,5.21,2.92,7.069    C117.676,343.069,120.246,344.14,122.886,344.14z"/>
                      </g>
                    </g>
                  </svg>
                </div>
                <div class="media-body">
                  <h3 class="heading mb-3 text-center text-12">Đăng tuyển du học miễn phí</h3>
                </div>
              </a>
            </div>
          </div>
          <div class="col-md-3  align-self-stretch ftco-animate" style="padding-left: 10px!important;">
            <div class="d_item v_block">
              <div class="media block-6 services d-block">
                <div class="icon text-center SB_bn">
                  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512"
                        style="enable-background:new 0 0 512 512;width: 47px; height: 65px; padding-top: 5px; padding-bottom: 10px;" xml:space="preserve"><g><g>
                      <path d="M421.054,414.843c-4.142,0-7.5,3.358-7.5,7.5v70.514c0,2.283-1.858,4.141-4.141,4.141h-40.317V349.301    c0-4.142-3.358-7.5-7.5-7.5c-4.142,0-7.5,3.358-7.5,7.5v147.698h-81.185l23.543-25.9c2.572-2.83,3.785-6.861,3.244-10.787    c-0.01-0.076-0.022-0.152-0.035-0.228L277.24,327.617l6.041-9.094c3.34,2.372,5.913,4.656,10.738,4.656    c4.908,0,9.497-2.747,11.755-7.269v-0.001l23.65-47.4l53.876,20.865c1.949,0.836,30.252,13.582,30.252,47.238v50.73    c-0.001,4.141,3.357,7.5,7.5,7.5c4.142,0,7.5-3.358,7.5-7.5v-50.73c0-44.344-37.969-60.463-39.585-61.128    c-0.047-0.02-0.095-0.039-0.143-0.057l-89.668-34.726v-21.03c14.242-11.076,24.117-27.495,26.596-46.227    c7.101-0.5,13.69-3.152,19.071-7.779c7.027-6.043,11.059-14.838,11.059-24.126c0-7.708-2.781-15.068-7.737-20.803V92.953    C348.144,41.699,306.446,0,255.192,0c-51.254,0-92.952,41.699-92.952,92.953v28.511c-5.009,5.677-7.733,12.665-7.733,20.074    c0,9.291,4.03,18.085,11.059,24.129c5.377,4.625,11.962,7.274,19.061,7.775c2.499,19.083,12.662,36.114,28.117,47.339v19.92    l-89.571,34.725c-0.047,0.018-0.094,0.037-0.141,0.056c-1.617,0.665-39.585,16.784-39.585,61.128v156.245    c0,10.555,8.587,19.142,19.142,19.142h71.457c4.142,0,7.5-3.358,7.5-7.5c0-4.142-3.358-7.5-7.5-7.5h-16.137V349.301    c0-4.142-3.358-7.5-7.5-7.5c-4.142,0-7.5,3.358-7.5,7.5v147.698h-40.319c-2.283,0-4.141-1.858-4.141-4.141V336.611    c0-33.769,28.493-46.486,30.243-47.234l53.834-20.87l23.652,47.402c2.263,4.533,6.858,7.27,11.756,7.27    c4.801,0,7.349-2.249,10.738-4.656l6.041,9.094l-22.421,132.468c-0.013,0.075-0.024,0.15-0.035,0.226    c-0.542,3.924,0.671,7.957,3.244,10.789l23.543,25.9h-29.995c-4.142,0-7.5,3.358-7.5,7.5s3.358,7.5,7.5,7.5h200.365    c10.555,0,19.142-8.588,19.142-19.142v-70.514C428.554,418.201,425.196,414.843,421.054,414.843z M315.375,263.069l-22.049,44.19    c-0.548-0.389-12.233-8.691-26.517-18.834c6.198-7.651-1.053,1.299,27.235-33.617L315.375,263.069z M271.043,309.833l-5.718,8.607    h-18.703l-5.718-8.607l15.07-10.703L271.043,309.833z M227.743,243.121v-14.036c9.112,3.673,18.85,5.376,28.36,5.376    c9.833,0,19.476-2.096,28.052-5.846v14.567l-28.181,34.785L227.743,243.121z M340.881,141.539    c-0.001,4.913-2.129,9.562-5.839,12.753c-2.453,2.11-5.416,3.459-8.661,3.987v-33.477    C335.001,126.202,340.881,133.352,340.881,141.539z M184.007,158.279c-8.718-1.415-14.5-8.623-14.5-16.741    c0-8.018,6.647-14.544,14.5-16.359V158.279z M184.41,109.896c-2.389,0.274-5.127,0.921-7.168,1.615V92.953    c0-42.983,34.968-77.952,77.951-77.952c42.983,0,77.951,34.969,77.951,77.952v18.043c-2.18-0.663-4.441-1.101-6.762-1.307    c0-7.237,0.063-5.841-23.612-31.294c-4.354-4.678-11.556-5.658-17.037-2.077c-26.13,17.069-58.005,25.644-87.415,23.532    C191.867,99.367,185.991,103.616,184.41,109.896z M199.008,164.184v-46.792v-2.465c32.375,1.896,66.318-7.722,93.739-25.283    c10.858,11.658,16.738,17.773,18.634,20.099c0,5.884,0,47.705,0,54.44c0,30.447-24.826,55.276-55.277,55.276    C221.91,219.46,199.008,192.934,199.008,164.184z M218.623,307.259l-22.049-44.19l21.293-8.247l27.241,33.625    C231.255,298.284,219.88,306.366,218.623,307.259z M227.228,461.702l21.709-128.263h14.071l21.709,128.263l-28.744,31.623    L227.228,461.702z"/></g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g>
                  </svg>
                </div>
                <div class="media-body">
                  <h3 class="heading mb-0 text-center text-12">Giới thiệu học sinh
                  </h3>
                  <p class="text-center text-12">Có học viên là có thưởng </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- tin nổi bật -->
    <div class="container">
      <section>
        <div class="row">
          <div class="col-lg-12 col-12">
            <div class="card">
              <!-- Carousel Options start -->
                <section id="carousel-options">
                    <div class="row match-height">
                        <div class="col-md-12 col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                  <h4 class="card-title"><i class="fad fa-business-time"></i> TIN NỔI BẬT </h4>
                                  <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                                  <a href="/tin-tuyen-sinh/tim-kiem?keyword=tin-noi-bat" class="btn bg-netbee">Xem thêm</a>
                                </div>
                                <div class="card-content" style="position:relative">
                                    <div class="card-body">
                                        <div id="carousel-interval" class="carousel slide" data-ride="carousel" data-interval="10000">
                                            <ol class="carousel-indicators">
                                                <li data-target="#carousel-interval" data-slide-to="0" class="active"></li>
                                                <li data-target="#carousel-interval" data-slide-to="1"></li>
                                            </ol>
                                            <div class="carousel-inner" role="listbox">
                                                <div class="carousel-item active">
                                                    <JobsList2Col :DataList="arrayJobHot"></JobsList2Col>
                                                </div>
                                                <div class="carousel-item">
                                                    <JobsList2Col :DataList="arrayJobHot2"></JobsList2Col>
                                                </div>
                                            </div>
                                            <a class="carousel-control-prev" href="#carousel-interval" role="button" data-slide="prev">
                                                <button class="el-carousel__arrow el-carousel__arrow--left">
                                                  <i class="fas fa-angle-left"></i>
                                                </button>
                                            </a>
                                            <a class="carousel-control-next" href="#carousel-interval" role="button" data-slide="next">
                                                <button class="el-carousel__arrow el-carousel__arrow--right">
                                                  <i class="fas fa-angle-right"></i>
                                                </button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Carousel Options end -->
            </div>
          </div>
        </div>
      </section>
    </div>
    <!--section Tại sao chon netbee-->
    <section class="ftco-section services-section card why" style="background: #fff; text-align:center">
      <div class="container">
        <h2 class="text-center NB_benefit" style="text-transform:uppercase">Tại sao nên chọn NetBee</h2>
        <div class="row " style="padding-left:14px!important;">
          <div class="col-md-3  align-self-stretch ftco-animate " style="padding-left:0!important; padding-right:10px!important">
            <div class="d_item v_block" style="">
              <a class="media block-6 services d-block" href="">
                <div class="icon text-center SB_bn">
                  <img v-lazy="`/assets/img/mang-luoi.png`" alt="">
                </div>
                <div class="media-body benefit-item-icon">
                  <h3 class="heading text-center" style="padding-top:10px">Mạng lưới rộng lớn</h3>
                  <p style="padding: 5px 15px 20px 15px; color:black">Với hơn 1000 học viên đã sang Đức, 1.200 học viên học viên đã sang Hàn Quốc, 600 học viên đã sang Nhật Bản.</p>
                </div>
              </a>
            </div>
          </div>
          <div class="col-md-3  align-self-stretch ftco-animate" style="padding: 0 10px">
            <div class="d_item v_block">
              <a class="media block-6 services d-block" href="">
                <div class="icon text-center SB_bn">
                  <img v-lazy="`/assets/img/CTV.png`" alt="">
                </div>
                <div class="media-body benefit-item-icon">
                  <h3 class="heading text-center" style="padding-top:10px">Hơn 4000 cộng tác viên</h3>
                  <p style="padding: 5px 15px 20px 15px; color:black">Với hơn 1000 học viên đã sang Đức, 1.200 học viên học viên đã sang Hàn Quốc, 600 học viên đã sang Nhật Bản.</p>
                </div>
              </a>
            </div>
          </div>
          <div class="col-md-3  align-self-stretch ftco-animate" style="padding: 0 10px;">
            <div class="d_item v_block bg__">
              <a class="media block-6 services d-block" href="">
                <div class="icon text-center SB_bn">
                  <img v-lazy="`/assets/img/ho-so.png`" alt="">
                </div>
                <div class="media-body benefit-item-icon">
                  <h3 class="text-center" style="padding-top:10px">Hơn 3000 hồ sơ</h3>
                  <p style="padding: 5px 15px 20px 15px; color:black">Với hơn 1000 học viên đã sang Đức, 1.200 học viên học viên đã sang Hàn Quốc, 600 học viên đã sang Nhật Bản.</p>
                </div>
              </a>
            </div>
          </div>
          <div class="col-md-3  align-self-stretch ftco-animate" style="padding-left: 10px!important;">
            <div class="d_item v_block">
              <div class="media block-6 services d-block">
                <div class="icon text-center SB_bn">
                  <img v-lazy="`/assets/img/doi-tac.png`" alt="">
                </div>
                <div class="media-body benefit-item-icon">
                  <h3 class="mb-0 text-center" style="padding-top:10px">Hơn 500 đối tác</h3>
                  <p style="padding: 5px 15px 20px 15px; color:black">Với hơn 1000 học viên đã sang Đức, 1.200 học viên học viên đã sang Hàn Quốc, 600 học viên đã sang Nhật Bản.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <div class="container">
      <!-- tin mới -->
      <section>
        <div class="row">
          <div class="col-lg-8 col-12 p-r-0">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title"><i class="fad fa-business-time"></i> TIN MỚI </h4>
                <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                <a href="/tin-tuyen-sinh/tim-kiem?keyword=" class="btn bg-netbee">Xem thêm</a>
              </div>
              <div class="card-content collapse show" style="padding: 13px">
                <div id="carousel-interval-new" class="carousel slide" data-ride="carousel" data-interval="10000">
                    <ol class="carousel-indicators">
                        <li data-target="#carousel-interval-new" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel-interval-new" data-slide-to="1"></li>
                    </ol>
                    <div class="carousel-inner" role="listbox">
                        <div class="carousel-item active">
                            <JobsList1Col :DataList="arrayJobNew"></JobsList1Col>
                        </div>
                        <div class="carousel-item">
                            <JobsList1Col :DataList="arrayJobNew2"></JobsList1Col>
                        </div>
                    </div>
                    <a v-if="arrayJobNew.length == 8" class="carousel-control-prev" href="#carousel-interval-new" role="button" data-slide="prev">
                        <button class="el-carousel__arrow el-carousel__arrow--left">
                          <i class="fas fa-angle-left"></i>
                        </button>
                    </a>
                    <a v-if="arrayJobNew.length == 8" class="carousel-control-next" href="#carousel-interval-new" role="button" data-slide="next">
                        <button class="el-carousel__arrow el-carousel__arrow--right">
                          <i class="fas fa-angle-right"></i>
                        </button>
                    </a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-12">
            <div class="card">
              <div class="card-content collapse show">
                <div class="card-body">
                  <section id="nav-filled">
                    <div class="row">
                      <div class="col-sm-12 p-0">
                        <div class="card overflow-hidden">
                          <div class="card-content">
                            <div class="card-body">
                              <!-- Nav tabs -->
                              <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
                                <li class="nav-item">
                                  <a class="nav-link active" id="home-tab-fill" data-toggle="tab" href="#home-fill"
                                      role="tab" aria-controls="home-fill" aria-selected="true"><i
                                    class="fad fa-align-center"></i> LĨNH VỰC</a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link" id="profile-tab-fill" data-toggle="tab" href="#profile-fill"
                                      role="tab" aria-controls="profile-fill" aria-selected="false"><i
                                    class="fas fa-map-marker-check"></i> KHU VỰC</a>
                                </li>
                              </ul>
                              <!-- Tab panes -->
                              <div class="tab-content pt-1">
                                <div class="tab-pane active list-item" id="home-fill" role="tabpanel"
                                      aria-labelledby="home-tab-fill">
                                  <ul class="nav flex-column">
                                    <li class="nav-item item" v-for="(item, index) in linhvuc" :key="index"><a :href="`tin-tuyen-sinh/tim-kiem?id_visa=${item.id}`"><i class="fad fa-location-arrow"></i> {{item.profession}}</a></li>
                                  </ul>
                                </div>
                                <div class="tab-pane" id="profile-fill" role="tabpanel"
                                      aria-labelledby="profile-tab-fill">
                                  <ul class="nav flex-column">
                                    <li class="nav-item item" v-for="(item, index) in quocgia" :key="index"><a :href="`tin-tuyen-sinh/tim-kiem?nation_id=${item.id}`"><i class="fad fa-location-arrow"></i> {{item.name}}</a></li>
                                  </ul>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </section>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- tin tức -->
      <section>
        <div class="row">
          <div class="col-lg-12 col-12">
            <div class="card">
              <div class="card-header">
                <h4><i class="fad fa-newspaper"></i> TIN TỨC</h4>
                <a href="/tin-tuc" class="btn bg-netbee">Xem thêm</a>
              </div>
              <div class="card-content collapse show news">
                <div class="card-body">
                  <NewsList :DataList="tintuc"></NewsList>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
</template>
<script>
  import JobsList1Col from '~/components/Jobs/JobsList1Col'
  import JobsList2Col from '~/components/Jobs/JobsList2Col'
  import NewsList from '../components/News/NewsList'

  export default {
    data() {
        return {
            arrayJobNew: [],
            arrayJobNew2: [],
            tintuc: [],
            arrayJobHot: [],
            arrayJobHot2: [],
            pageLoadingHot: 1,
            pageLoadingNew: 1,
            linhvuc: [],
            quocgia: []
        }
    },
    components: {
      JobsList2Col,
      NewsList,
      JobsList1Col
    },
    methods: {
      fetch() {
        this.$axios.$get(`getTinTuyenDungNewCarousel?page=1`).then((ress) => {
          var myArray = ress.data.tintuyendung.data
          var index = 0;
          var arrayLength = myArray.length;
          var tempArray = [];
      
          for (index = 0; index < arrayLength; index += 8) {
              var myChunk = myArray.slice(index, index+8);
              tempArray.push(myChunk);
          }
          
          this.arrayJobNew = tempArray[0];
          this.arrayJobNew2 = tempArray[1];
        })
        // this.$axios.$get(`getTinTuyenDungNewCarousel?page=2`).then((ress) => {
        //   this.arrayJobNew2 = ress.data.tintuyendung.data
        // })
        this.$axios.$get(`getTinTuyenDungHotCarousel?page=1`).then((ress) => {
          this.arrayJobHot = ress.data.tintuyendung.data

        })
        this.$axios.$get(`getTinTuyenDungHotCarousel?page=2`).then((ress) => {
          this.arrayJobHot2 = ress.data.tintuyendung.data
        })

        this.$axios.$get(`getTinTucNew?limit=4`).then((ress) => {
          this.tintuc = ress.data.tintuc
        })
        this.$axios.$get(`getVisa`).then((ress) => {
          this.linhvuc = ress.data
        })
        this.$axios.$get(`getQuocGia`).then((ress) => {
          this.quocgia = ress.data
        })
      },
    },
    mounted() {
        this.fetch();
    }
  }
</script>
<style scoped>
  @media (min-width: 1000px) {
    .jobs .card-body {
      max-height: 375px;
    }
  }

  .ftco-section {
    padding: 20px 0px 20px 0px;
    position: relative;
  }

  .NB_benefit {
    font-size: 24px;
    line-height: 28px;
    font-weight: bold;
    margin-bottom: 20px;
  }

  .benefit-item-icon h3 {
    font-size: 16px;
    font-weight: bold;
    margin-bottom: 0px;
    line-height: 16px;
  }

  .ftco-counter {
    background-color: white;
    box-shadow: 0 4px 25px 0 rgba(0, 0, 0, 0.1);
  }

  .col-md-2 {
    position: relative;
    width: 100%;
    min-height: 1px;
    padding-right: 10px;
    padding-left: 10px;
  }

  .d_item.v_block {
    width: 100%;
    padding: 0px 5px;
    height: 120px;
    border-radius: 3px;
    box-shadow: 0 1px 1px #887e7e;
    -webkit-box-shadow: 0 2px 3px #ada5a5;
    -moz-box-shadow: 0px 3px 2px #000;
    box-shadow: 0 1px 4px #887e7e !important;
    -webkit-box-orient: 0 2px 3px #ada5a5 !important;
    -moz-box-shadow: 0px 3px 2px #000;
  }

  .services .icon {
    line-height: 1.3;
    position: relative;
  }

  .SB_bn {
    padding: 13px 0 0 5px !important;
    color: #000 !important;
    font-size: 40px !important;
  }
  .ftco-animate h3{
    font-size: 16px;
  }
  .d_item.v_block:hover {
    background: #ffb701;
    cursor: pointer;
  }
  .why .d_item.v_block:hover{
    background-color: white!important ;
    color:black!important;
  }
  .why .d_item.v_block p:hover{
    color:black!important;
  }
  .why .d_item.v_block{
    height:auto;
    text-align:center;
    box-shadow: 0 1px 2px #887e7e !important;
  }

  .item{
    padding: 8px 0;
    border-bottom: 1px dotted #ddd;
  }

  .list-item{
    max-height: 400px;
    overflow-y: auto;
  }
  /* width */
  .list-item::-webkit-scrollbar {
    width: 3px;
  }

  /* Track */
  .list-item::-webkit-scrollbar-track {
    box-shadow: inset 0 0 5px rgba(128, 128, 128, 0.192);
    border-radius: 10px;
  }

  /* Handle */
  .list-item::-webkit-scrollbar-thumb {
    background: rgba(78, 78, 78, 0.507);
    border-radius: 10px;
  }

  /* Handle on hover */
  .list-item::-webkit-scrollbar-thumb:hover {
    background: rgba(78, 78, 78, 0.404);
  }

</style>
