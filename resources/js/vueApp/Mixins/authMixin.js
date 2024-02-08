export const getLoginUser =  () => {
   return  localStorage.getItem("logedInUser") ? JSON.parse(localStorage.getItem('logedInUser')) : null;
};

export const isAuth =  () => {
   return  localStorage.getItem("isAuth") ? JSON.parse(localStorage.getItem('isAuth')) : false;
};
