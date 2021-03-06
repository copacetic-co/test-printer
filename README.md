
![](https://raw.githubusercontent.com/defenestrator/test-printer/master/assets/images/copacetic-face.png)

# Defenestrator Test Printer

Rather than see a string of dots and letters, get some darn information as your tests are running. 

![](https://raw.githubusercontent.com/defenestrator/test-printer/master/assets/images/screenshot.png)

## Installation

Install Defenestrator Test Result Printer with composer:

	composer require --dev defenestrator/test-printer

You may alternatively include the project in your composer.json:

```json
	{
		"require-dev": {
			"defenestrator/test-printer": ">=3.0.0"
		}
	}
```

If you don't use composer, you can simply download and save `TestResultPrinter.php` wherever you want. 
You should seriously use composer, dork.

## Usage

To use the `TestResultPrinter` class,  specify it in the root `<phpunit>` element of `phpunit.xml`. 

```
<phpunit
    colors="true"
    printerClass="Defenestrator\TestResultPrinter"
    >
    ...
</phpunit>
```
