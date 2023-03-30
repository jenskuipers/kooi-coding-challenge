# Schedule problem

There are 2 ways to represent a schedule. The first is a matrix of times and states, the second is a list of timeframes.

## Matrix

The matrix is an object of days in which, for each day, the matrix is a list of quarter-hour intervals. Each interval has a boolean value indicating whether the quarter has an active or inactive timeframe.

You can find the input matrices in the `input` folder.

## Timeframes

The timeframes are a list of objects with a start and end time.

You can find the output timeframes in the `output` folder.

The value `false` in the matrix determines that the timeframe is active, and the value `true` determines that the timeframe is inactive. Only the active timeframes should be returned.

## Problem

The problem is to convert each matrix in the `input` folder to a list of timeframes corresponding to the same timeframe in the `output` folder.

### Example

The (incomplete) matrix for `monday` can be:

```json
{
  "00:00": false,
  "00:15": false,
  "00:30": false,
  "00:45": true,
  "01:00": true,
  "01:15": false,
  "01:30": false,
  "01:45": false,
  "02:00": false,
  // Each remaining interval has the value true
}
```

The output for `monday` should be:

```json
[
  {
    "from": null,
    "to": "00:45",
  },
  {
    "from": "01:15",
    "to": "02:15",
  }
]
```

### Requirements

- The code should be written in PHP
- When the starttime of an entry in the timeframe is "00:00", the value "from" should be `null`.
- When the endtime of an entry in the timeframe is "24:00", the value "to" should be `null`.
- (Optional): The code should be tested

## Comments

Like a math exam, the result is not important, the path to get to the result is.

If you have any questions, or need help, contact me at ad.bouma@247kooi.com or (06) 43 57 15 27.
