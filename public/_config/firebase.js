// import { initializeApp } from 'firebase/app';
// import { getFirestore, collection, getDocs } from 'firebase/firestore/lite';

const config = {
  apiKey: "AIzaSyDl0CZgnXZoVW9cVnxcjIXpsw_OJ13pJ-8",
  authDomain: "digitaldesk-18348.firebaseapp.com",
  projectId: "digitaldesk-18348",
  storageBucket: "digitaldesk-18348.firebasestorage.app",
  messagingSenderId: "514653264950",
  appId: "1:514653264950:web:81f40df58727a55c060c97",
  measurementId: "G-ND8L5H8YCB"
};

// Initialize Firebase
const app = firebase.initializeApp(config);
// const db = getFirestore(app);

// //create your custom method
// const getItems = () => {
//   return getDocs(collection(db, "items"));
// };