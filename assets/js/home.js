import '../styles/home.scss';

const buttonRightClient = document.getElementById('slideRightClient');
const buttonLeftClient = document.getElementById('slideLeftClient');

buttonRightClient.onclick = function () {
    document.getElementById('clientScrolling').scrollLeft += (window.innerWidth * 0.18);
};
buttonLeftClient.onclick = function () {
    document.getElementById('clientScrolling').scrollLeft -= (window.innerWidth * 0.18);
};

const buttonRightPartner = document.getElementById('slideRightPartner');
const buttonLeftPartner = document.getElementById('slideLeftPartner');

buttonRightPartner.onclick = function () {
    document.getElementById('partnerScrolling').scrollLeft += (window.innerWidth * 0.18);
};
buttonLeftPartner.onclick = function () {
    document.getElementById('partnerScrolling').scrollLeft -= (window.innerWidth * 0.18);
};
