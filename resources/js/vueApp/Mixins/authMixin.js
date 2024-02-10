export const getLoginUser =  () => {
   return  localStorage.getItem("logedInUser") ? JSON.parse(localStorage.getItem('logedInUser')) : null;
};

export const isAuth =  () => {
   return  localStorage.getItem("isAuth") ? JSON.parse(localStorage.getItem('isAuth')) : false;
};
export const getRole =  () => {
   return  localStorage.getItem("role") ?localStorage.getItem('role') : false;
};
export const logOut =  () => {
    localStorage.clear();
}
