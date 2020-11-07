function DetectBrowser()
{
    let browser = { "name": "underfined", "version": "underfined", "fullname": "underfined" };
    let browsers = {
        "firefox": "Mozilla Firefox",
        "opera": "Opera",
        "chrome": "Google Chrome",
        "ie": "Internet Explorer",
        "edge": "Microsoft Edge",
        "safari": "Apple safari",
    };
    for (let brow in browsers)
    {
        if (is[brow]())
        {
            browser.name = browsers[brow];
            browser.fullname = browsers[brow];
            for (let ver = 0; ver < 200; ver++)
            {
                if (is[brow](ver))
                {
                    browser.version = ver;
                    browser.fullname += " " + ver
                    break;
                }
            }
        }
    }
    return browser;
}
function DetectSystem()
{
    let system = { "os_name": "underfined", "os": "underfined", "device": "underfined", "fullname": "underfined" };
    system.os_name = navigator.platform;

    let os = {
        "android": "Google Android",
        "ios": "Apple ios",
        "windows": "Microsoft Window",
        "linux": "Linux",
    };
    let devices = {
        "mobile": "Phone",
        "tablet": "Tablet",
        "desktop": "Desktop",
        "touchDevice": "Any Touch Device",
    };
    system.os = For(os);
    system.device = For(devices);
    if (system.os == "underfined")
    {
        for (let i in os)
        {
            if (system.os_name.toLowerCase().indexOf(i.toLowerCase()) != -1)
            {
                system.os = os[i];
                break;
            }
        }
    }
    if (system.os != "underfined" && system.device != "underfined")
    {
        system.fullname = system.os + " " + system.device;
    }

    function For(arr)
    {
        for (let i in arr)
        {
            if (is[i]())
            {
                return arr[i];
            }
        }
        return "underfined";
    }
    return system;
}
alert(is.ie());
let nav = window.navigator;
let data = new Object();

// language
data.lang = new Object();
data.lang.language = nav.language;
data.lang.languages = nav.languages;

// browse/system
data.browser = DetectBrowser();
data.system = DetectSystem();

// location
data.location = new Object();
data.location.url = window.location;
data.location.page_title = document.getElementsByTagName("title")[0].innerHTML;
data.location.page_name = document.getElementsByName("page_name")[0].getAttribute("content");

data = JSON.stringify(data);

axios({
    method: 'post',
    url: 'analystic.php',
    data: {
        userAgent: data
    }
}).then((response) => {
    console.log("AVA: " + response.data);
});