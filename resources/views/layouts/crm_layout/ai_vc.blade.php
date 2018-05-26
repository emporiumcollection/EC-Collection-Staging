<!--AIC: VC Style Start-->
<style>
    .ui-droppable-active {
        background-color: #eeeeee;
    }
    .ui-state-default {
        border: medium none;
    }
    .ai-sortable-fields .ui-state-default, .ai-sortable-fields .ui-state-highlight {
        /*min-height: 110px;*/
        margin: 5px;
        display: inline-block;
        background: transparent;
    }
    .ui-state-highlight {
        border: medium none;
    }
    .draggable-element {
        width: calc(50% - 10px);
    }

    .portlet.light {
        float: left;
        width: 100%;
    }
    .form-actions.noborder.right {
        float: left;
        width: 100%;
    }
    .tabbable-line {
        float: left;
        width: 100%;
    }

    /*
     * Layout Style
     */

    .custom-rows .row-btns-tab {
        background-color: #ddd;
        padding: 10px;
        margin-bottom: 10px;
    }
    .custom-rows .row-btns-tab a {
        font-size: 16px;
        background-color: #333;
        color: #fff;
        display: inline-block;
        margin-right: 5px;
        height: 24px;
        width: 24px;
        text-align: center;
    }
    .custom-rows .row-btns-tab select {
        height: 23px;
        border: 1px solid #ddd;
    }
    .custom-rows .ai-sortable-fields {
        background-color: #ddd;
        float: left;
        width: 100%;
        padding: 10px;
    }
    .custom-rows .draggable-element {
        background-color: #eee;
        margin: 0 5px 10px 5px;
    }

    /*
     * VC
     */

    .vc-container {
        float: left;
        width: 100%;
        margin-bottom: 20px;
    }
    .row-container {
        float: left;
        width: 100%;
        margin: 0 5px 20px 5px;
    }
    .row-head {
        float: left;
        width: 100%;
    }
    .left-icons {
        float: left;
        width: 50%;
    }
    .right-icons {
        float: left;
        width: 50%;
        text-align: right;
    }
    .row-content {
        /*background-color: #E6E6E6;*/
        float: left;
        width: 100%;
        padding: 20px;
    }
    .row-container .left-icons a, .row-container .right-icons a {
        background-color: #E6E6E6;
        color: #898989;
        padding: 5px 15px;
        font-size: 15px;
    }
    .row-bottom {
        float: left;
        width: 100%;
        text-align: center;
        background-color: #E6E6E6;
        color: #898989;
        padding: 5px 0;
    }
    .row-bottom a {
        color: #898989;
    }
    .row-content .vc-tabs ul.nav.nav-tabs li a {
        background-color: #C9C9C9 !important;
        color: #333333;
        padding: 5px 10px;
        font-size: 12px;
    }
    .row-content .vc-tabs ul.nav.nav-tabs > li.active a {
        background-color: #DDDDDD !important;
    }
    .row-content .vc-tabs ul.nav.nav-tabs {
        margin: 0;
    }
    .row-content .vc-tabs .tab-content {
        float: left;
        width: 100%;
        background-color: #dddddd;
        padding: 10px;
    }
    .vc-tab-content-bottom {
        float: left;
        width: 100%;
        text-align: center;
    }
    .row-container .vc-tab-content-bottom a {
        color: #898989;
        padding: 5px 5px;
    }
    .vc-tab-content .draggable-element {
        /*background-color: #E6E6E6;*/
        margin: 0 5px 10px 5px;
        padding: 0;
    }
    .vc-field-icons {
        float: left;
        width: 100%;
    }
    .vc-left-icons {
        float: left;
        width: 30%;
    }
    .vc-right-icons {
        float: left;
        width: 70%;
        text-align: right;
    }
    .vc-field-cotainer {
        float: left;
        width: 100%;
    }
    .vc-field-icons div > i, .vc-field-icons div > a, .vc-left-icons .dropdown, .row-head .dropdown {
        background-color: #E6E6E6;
        display: inline-block;
        padding: 5px 10px;
    }
    .vc-field-cotainer {
        /*background-color: #E6E6E6;*/
        padding: 10px 15px;
    }

    .vc-tab-content-bottom .dropdown, .row-head .dropdown {
        display: inline-block;
    }
    .vc-tab-content-bottom .dropdown .dropdown-toggle, .row-head .dropdown .dropdown-toggle {
        color: #898989;
    }
    .vc-tab-content-bottom .dropdown .dropdown-menu {
        min-width: 290px;
        margin: 0;
        border: none;
        box-shadow: none;
        background-color: #E6E6E6;
        top: -4px;
        left: 20px;
    }
    .row-head .dropdown .dropdown-menu {
        min-width: 290px;
        margin: 0;
        border: none;
        box-shadow: none;
        background-color: #E6E6E6;
        top: 0px;
        left: 35px;
    }
    .vc-tab-content-bottom .dropdown .dropdown-menu:before, .row-head .dropdown .dropdown-menu:before {
        border: medium none;
    }
    .vc-tab-content-bottom .dropdown .dropdown-menu li, .row-head .dropdown .dropdown-menu li {
        display: inline-block;
    }
    .vc-tab-content-bottom .dropdown .dropdown-menu li a, .row-head .dropdown .dropdown-menu li a {
        padding: 5px;
    }
    .vc-add-new-row {
        background-color: #E6E6E6;
        float: left;
        width: 100%;
        text-align: center;
        padding: 25px;
    }
    .vc-add-new-row .add-new-row-btn {
        color: #898989;
        border: 1px dashed #898989;
        padding: 7px 15px;
        font-size: 26px;
    }
    .vc-columns {
        float: left;
        width: 100%;
    }
    .vc-column {
        float: left;
        padding: 5px;
        /*background-color: #dddddd;*/
        margin: 5px;
    }
    .vc-column .draggable-element {
        width: calc(100% - 10px);
    }
    .vc-column-bottom {
        text-align: center;
        font-size: 14px;
        color: #898989;
        float: left;
        width: 100%;
    }
    
    .vc-elements {
        float: left;
        width: 100%;
    }
    .vc-element {
        border: 1px solid #fff;
        float: left;
        width: 50%;
        margin: 10px 0;
        padding: 10px;
    }
    .vc-element:hover {
        border: 1px solid #757575;
    }
    .vc-element .vc-element-left {
        float: left;
        width: 50px;
    }
    .vc-element .vc-element-left .vc-element-icon {
        width: 100%;
    }
    .vc-element .vc-element-right {
        float: left;
        width: calc(100% - 50px);
        padding: 0 15px;
    }
    .vc-element .vc-element-title {
        color: #333333;
        font-size: 16px;
    }
    .vc-element .vc-element-description {
        color: #757575;
        font-size: 12px;
    }
    
    .vc-color-picker-holder .minicolors {
        width: 100%;
    }
    .vc-color-picker-holder .vc-color-picker {
        width: 100%;
        height: auto;
    }
</style>
<!--AIC: VC Style End-->