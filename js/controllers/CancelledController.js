app.controller('CancelledController', ['$rootScope', '$scope', '$filter', '$routeParams', '$http', '$timeout', function ($rootScope, $scope, $filter, $routeParams, $http, $timeout) {

        $scope.Customer_actives = [];

        $scope.sortingOrder = 'id';
        $scope.reverse = false;
        $scope.itemsPerPage = 10;
        $scope.currentPage = 1;




        $http.get('./Backend/web/index.php?r=api/get_customer_cancelled').then(function success(response) {
            $scope.Customer_actives = response.data;
            $rootScope.TotalCancelled = $scope.Customer_actives.length;
        });

        $scope.getData = function () {
            return $filter('filter')($scope.Customer_actives, $scope.searchbox);
        };

        $scope.numberOfPages = function () {

            return Math.ceil($scope.getData().length / $scope.itemsPerPage);
        };

        $scope.getTimes = function () {
            var times = $scope.numberOfPages();
            $scope.local_array = [];
            for (var i = 0; i < times; i++) {
                $scope.local_array.push(i);
            }
            return  $scope.local_array;
        };

        $scope.resetPage = function () {
            $scope.currentPage = 1;
            $scope.getTimes();
        };

        // change sorting order
        $scope.sort_by = function (newSortingOrder) {
            if ($scope.sortingOrder == newSortingOrder)
                $scope.reverse = !$scope.reverse;

            $scope.sortingOrder = newSortingOrder;
        };

        $scope.displayingStart = function () {
            if ($scope.getData().length == 0 || $('#customer-table>tbody>tr').length == 0)
                return 0;
            else
                return ($scope.currentPage - 1) * $scope.itemsPerPage + 1;
        };

        $scope.displayingEnd = function () {
            return ($scope.currentPage - 1) * $scope.itemsPerPage + $('#customer-table>tbody>tr').length;
        };


        $scope.change_page = function (key) {
            $scope.currentPage = key;

        };

        $scope.get_type_member = function (key) {
            var String = "";
            switch (key) {
                case "1":
                    String = "Vista";
                    break;
                case "2":
                    String = "Semanal";
                    break;
                case "3":
                    String = "Mensual";
                    break;
            }
            return String;
        };

        $scope.get_service = function (key) {
            var String = "";
            switch (key) {
                case "1":
                    String = "GYM";
                    break;
                case "2":
                    String = "OTHER";
                    break;
                case "3":
                    String = "OTHER";
                    break;
            }
            return String;
        };

    }]);