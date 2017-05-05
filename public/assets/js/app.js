(function () {
    angular.module('UserApp',[])
        .controller('UserCtrl',['$scope','User',UserCtrl])
        .factory("User",User);
    
        function User() {
            
        } 
        function UserCtrl($scope, User) {

            $scope.Likepost = function (user) {
                alert('Liked');
            }
        }
});