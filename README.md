# Remote Code Execution (RCE) and Local File Inclusion (LFI) Vulnerabilities

This PHP code snippet demonstrates potential vulnerabilities for Remote Code Execution (RCE) and Local File Inclusion (LFI) if not properly handled.

## Description

The provided PHP code contains two sections, each representing a common vulnerability:

1. **Local File Inclusion (LFI)**: This vulnerability arises from the `$file` parameter being directly incorporated into the `file_get_contents()` function without proper validation. If an attacker can manipulate the `$file` parameter, they could potentially include sensitive files from the server.


2. **Remote Code Execution (RCE)**: The `$command` parameter, if not properly sanitized, can lead to remote code execution. The code uses the `system()` function to execute shell commands based on the input provided through the `$command` parameter. If an attacker can inject malicious commands, they could execute arbitrary code on the server.




## How to Use

To demonstrate these vulnerabilities, follow the instructions below:

1. **LFI**: Put in the input the name of the file or the path of the file. It will send something like this: `http://example.com/vulnerable.php?file=/etc/passwd`. Ensure that the file you're trying to include exists and is accessible.


![imagen](https://github.com/notluken/Teaching-LFI-RCE/assets/74316806/abc1b7fb-8d71-4a78-8f60-4b13238f1bde)

2. **RCE**: Put in the input the command you want to execute on the server. It will send something like this: `http://example.com/vulnerable.php?command=ls -la`. This executes the `ls -la` command on the server. 

![imagen](https://github.com/notluken/Teaching-LFI-RCE/assets/74316806/0e590e76-dcfe-4292-81a9-63948a024c2c)

## Mitigation

To mitigate these vulnerabilities, follow these best practices:

- **LFI**: Validate and sanitize user input before using it to include files. Whitelist acceptable file paths and ensure that the user-supplied file actually exists and is allowed to be included.
- **RCE**: Sanitize user input thoroughly. Avoid using functions like `system()` to execute commands directly. If command execution is necessary, use functions like `escapeshellcmd()` to escape potentially dangerous characters.

Always keep your software up-to-date and follow secure coding practices to minimize the risk of such vulnerabilities.

**Note**: This code is for educational purposes only. Never deploy such vulnerable code in a production environment.
