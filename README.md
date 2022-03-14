# Trading Tests

## Source code
Source code is in the file `process_trades.php`

## build instructions
Please install PHP 8.1 and then from the command prompt run:
```
 php .\process_trades.php input.csv output.csv
```

## Setup to run on daily basis
Run AWS lambda function then export the resulting csv file with the time stamp as the file name to the S3 bucket.

## monitoring execution of tasks
Run cloudwatch export logs

## Time taken
2 hours

## Thoughts on OS/Language/tools
I use windows as my OS because that is the computer that I have

I uses PHP because that is the Language I am most familiar of.
