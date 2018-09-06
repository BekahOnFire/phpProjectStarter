<?php
    /*
     * Written by Mind State Software Developing, Inc.
     * PHP Project Starter                 Version 1.0
     * September 2018
     */
 
class webDisplay
{
    /*
     * Web Header Display
     */
    public function showHeader($Title) {
        $buf = "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 "
           . "Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">\n"
           . "<html xmlns=\"http://www.w3.org/1999/xhtml\">\n"
           . "<head>\n"
           . "    <meta http-equiv=\"Content-Type\" content=\"text/html;charset=iso-8859-1\" />\n"
           . "    <META HTTP-EQUIV=\"Pragma\" CONTENT=\"no-cache\">\n"
           . "    <META HTTP-EQUIV=\"Expires\" CONTENT=\"-1\">\n"
           . "    <title>" . $Title . "</title>";
        return $buf;
    }

    public function justTheHeader() {
        $buf = "<head>\n"
           . "    <meta http-equiv=\"Content-Type\" content=\"text/html;charset=iso-8859-1\" />\n"
           . "    <META HTTP-EQUIV=\"Pragma\" CONTENT=\"no-cache\">\n"
           . "    <META HTTP-EQUIV=\"Expires\" CONTENT=\"-1\">\n" ;
        return $buf;
    }

    public function displayHdrTagClose()
    {
        return "</head>\n";
    }

    public function displayCssLink($cssName)
    {
        return "    <link rel=\"stylesheet\" type=\"text/css\" href=\"/css/" . $cssName . "\">";
    }

    public function displayJsScript($jsName)
    {
        return "<script type=\"text/JavaScript\" src=\"/js/" . $jsName . "\"></script>\n";
    }

    public function displayBodyTag($extraParam)
    {
        return "<body " . $extraParam . ">\n";
    }

    public function displayLogo($extraParam)
    {
        if ( true ) return "";
        return "<div class=\"left\"><div id=\"logo\">\n"
           . "    <a href=\"http://www.mindstatedev.com/\" title=\"Mindstate Software Development Home\">"
           . "    <img alt=\"Logo\" border=\"0\" src=\"/images/basicSiteIcon.jpg\" "
           . "    class=\"style1\" height=\"67\" width=\"386\"></a>\n"
           . "    </div>\n"
           . "</div>\n";
    }

    /*
     * Web Sidebar
     */
    public function displaySideBar() {
        $buf = "      <span style=\"font-size:30px;cursor:pointer\" onclick=\"openNav()\" title=\"Click to show Menu\">&#9776;</span>\n"
           . "<div id=\"mySidenav\" class=\"sidenav\">\n"
           . "<div class=\"left\"><div id=\"logo\">\n"
           . "    <a href=\"http://www.mindstatedev.com/\" title=\"Mindstate Software Development Home\">"
           . "    <img alt=\"Logo\" border=\"0\" src=\"/images/basicSiteIcon.jpg\" "
           . "    class=\"style1\" height=\"67\" width=\"210\"></a>\n"
           . "    </div>\n"
           . "</div>\n" .
           "<a href=\"javascript:void(0)\" class=\"closebtn\" onclick=\"closeNav()\"><font color=\"ffffff\">&times;</font></a>\n" .
           "<a href=\"/basicPHP.php\">Dashboard</a>\n" .
           "<a href=\"/basicReports.php\">Reports</a>\n" .
           "<a href=\"/basicLogin.php?logout=Log Out\">Logout</a>\n" .
       "</div>\n" .

       "<script>\n" .
       "function openNav() {\n" .
           "document.getElementById(\"mySidenav\").style.width = \"250px\";\n" .
           "document.getElementById(\"main\").style.marginLeft = \"250px\";\n" .
       "}\n" .

       "function closeNav() {\n" .
           "document.getElementById(\"mySidenav\").style.width = \"0\";\n" .
           "document.getElementById(\"main\").style.marginLeft= \"0\";\n" .
       "}\n" .
       "</script>";
        return $buf;
    }

    /*
     * Example Web page.
     */
    public function displayTypicalPage($pageTitle, $inputFormName, $pageActionPath) {
        $hldPageTitle = "<h2>" . $pageTitle . "</h2>\n";
        if ( $pageTitle == null)
            $hldPageTitle = "";
        // Background image for page display.  Change as needed.
        $buf = "<div id=\"main\" style=\"background-image: url('/images/dasDivSystem.gif');background-repeat: no-repeat;background-size:900px 600px;width: 940px; height: 600px;\">\n" .
            $hldPageTitle .
            "<form name=\"" . $inputFormName . "\" method=\"POST\" action=\"/ontrial/" . $pageActionPath . "\">\n" .
        "\n";
        return $buf;
    }

    /*
     * Start Test Plan Content configuration
     */
    public function displayTestPlanContent() {
        $buf = "<div id=\"main\">\n" .
            "<h2>Test Plan Content</h2>\n" .

            "<form name=\"testScriptInputForm\" id=\"testScriptInputForm\" method=\"POST\" action=\"/ontrial/popups/manageTestPlanContents.jsp\">\n" .
        "\n";
        return buf;
    }

    /*
     * Close the Input Form.
     */
    public function displayCloseInputForm() {
        $returnString = "</form>\n";
        return $returnString;
    }

    /*
     * Floating Div Popup.  Header half.
     */
    public function displayLightBoxHeader( $boxWidth, $boxHeight) {
        $returnString = "<div class=\"floater\"><div id=\"light\" class=\"white_content\" style=\"width: " . $boxWidth . "px;height: " . $boxHeight . "px;\">\n"
            . "<div class=\"addClose\"><a href = \"javascript:void(0)\" onclick = \"document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'\">Close</a></div>\n";

        return $returnString;
    }

    /*
     * Floating Div Popup.  Footer half.
     */
    public function displayLightBoxFooter() {
        $returnString = "<div id=\"fade\" class=\"black_overlay\"></div>\n"
            . "</p>\n"
            . "</div>\n"
            . "</div>\n";

        return $returnString;
    }

    // HTML Page.
    public function displayHTMLPageClose()
    {
        return "</body>\n"
           . "</html>\n";
    }

    // HTML Page footer.
    public function displayHTMLPageFooter()
    {
        return "<center><p class=\"foot\">\n"
           . "<a class=\"foot\" href=\"http://www.mindstatedev.com\">Mind State Software Developing Inc.</a>\n"
           . "<br>\n"
           . "All Logos and Trademarks in this site are the property of their respective owners. \n"
           . "<br>version 1.0\n"
           . "</p></center>\n";
    }
}
?>
