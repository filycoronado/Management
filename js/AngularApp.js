var app = angular.module('myApp', ['ngRoute', 'pascalprecht.translate', 'ngAnimate', 'ngCookies', 'ui.bootstrap', 'ui.mask']);

angular.lowercase = text => text.toLowerCase();


localStorage.setItem("Nombre", "test");

app.config(function ($routeProvider) {
    $routeProvider
    .when("/", {
        templateUrl: "./pages/Home.html",
        controller: "HomeController"
    }).when("/[Hh]ome/", {
        templateUrl: "./pages/Home.html",
        controller: "HomeController"
    }).when("/User/Transactions", {
        templateUrl: "./pages/transactions.html",
        controller: "transactionController"
    }).when("/Edit/Transactions/:id", {
        templateUrl: "./pages/edit_transaction.html",
        controller: "edit_transactionController"
    }).when("/Policy/New/:id", {
        templateUrl: "./pages/NewPolicy.html",
        controller: "NewPolicyController"
    }).when("/Customer/Edit/:id", {
        templateUrl: "./pages/EditCsutomer.html",
        controller: "CsutomerEditController"
    }).when("/New/Customer/", {
        templateUrl: "./pages/Register.html",
        controller: "NewCustomerCController"
    }).when("/Policy/Payment/:pol/:cus", {
        templateUrl: "./pages/MakePayment.html",
        controller: "PaymentController"
    }).when("/Policy/History/:id", {
        templateUrl: "./pages/PaymentHistory.html",
        controller: "PaymentHistoryController"
    }).when("/Policy/Edit/:pol/:cus", {
        templateUrl: "./pages/UpdatePolicy.html",
        controller: "UpdatePolicyController"
    }).when("/Policy/Status/:pol/:cus", {
        templateUrl: "./pages/ProfileStatus.html",
        controller: "UpdatePolicyController"
    }).when("/Report/Sales", {
        templateUrl: "./pages/SalesReport.html",
        controller: ""
    }).when("/Admin/Users", {
        templateUrl: "./pages/Users.html",
        controller: "AdminUserController"
    }).when("/Customer/Profile/:id", {
        templateUrl: "./pages/CustomerProfile.html",
        controller: "CustomerProfileController"
    }).when("/Customer/services/payemnt/:id", {
        templateUrl: "./pages/Payment.html",
        controller: "CustomerPaymentController"
    });
});

app.config(['$locationProvider', function ($locationProvider) {
        $locationProvider.hashPrefix('');
    }]);

app.filter('startFrom', function () {
    return function (input, start) {
        if (!input || !input.length) {
            return;
        }
        start = +start; //parse to int
        return input.slice(start);
    }
});
