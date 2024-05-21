$(document).ready(function () {
  // <img src="./assets/img/unknown.jpg" alt="dev">
  const ourTeam = [
    {
      id: "#edson",
      imgElement: '<img src="./assets/img/EdsonSantos.jpeg" alt="dev" />',
    },
    {
      id: "#rafael",
      imgElement: '<img src="./assets/img/RafaelAraujo.jpeg" alt="dev" />',
    },
    {
      id: "#cesar",
      imgElement: '<img src="./assets/img/CesarCardoso.jpeg" alt="dev" />',
    },
    {
      id: "#carlos",
      imgElement: '<img src="./assets/img/CarlosDaniel.jpeg" alt="dev" />',
    },
    {
      id: "#nadia",
      imgElement: '<img src="./assets/img/NadiaDiniz.jpeg" alt="dev" />',
    },
    {
      id: "#bruno",
      imgElement: '<img src="./assets/img/BrunoKitaya.jpeg" alt="dev" />',
    },
  ];

  ourTeam.forEach((p) => {
    $(p.id).prepend(p.imgElement);
  });
});
