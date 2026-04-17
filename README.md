# HumHub Follow All

HumHub module that makes **new users** **automatically follow** all existing **active** users in the system.

---

## Overview

Once enabled, every newly created account starts already “connected” to the rest of the community, improving:

- **Early engagement** (the user already sees updates from people)
- **Onboarding experience**
- **Adoption** in corporate/community environments

---

## Features

- **Auto-follow on signup**
  - Newly created users follow all existing **active** users.
- **Works with large instances**
  - Using **cron/queue** is recommended for large installations.

---

## Requirements

- A working HumHub installation
- Admin panel access to install/enable modules

---

## Installation

### Option 1) Install from source (repository)

1. Download/clone this repository.
2. Copy the module folder to:

   ```
   protected/modules/humhub-follow-all
   ```

3. In the HumHub Admin panel, go to:

   `Administration -> Modules`

4. Find **Follow All** and click **Enable**.

### Option 2) Manual install (zip)

1. Download the project as a `.zip`.
2. Extract it to `protected/modules/humhub-follow-all`.
3. Enable the module in the admin panel.

---

## Settings

Module settings are available at:

`Administration -> Modules -> Follow All -> Configure`

### Available options

- **Send notifications when following users** (`sendNotifications`)
  - When enabled, HumHub may **send notifications** when creating follow relationships.
  - This applies to both **signup auto-follow** and the **daily routine** (if enabled).

- **Keep everyone following everyone (daily sync)** (`followAllUsers`)
  - When enabled, a **daily** routine ensures that **all active users follow each other**.
  - Important: this daily sync **ignores manual unfollow** (if someone unfollows, the relationship may be recreated the next day).

---

## Cron / Queue (recommended)

In large communities, creating follow relationships for a new user can generate many operations.

Also, if you enable **Keep everyone following everyone (daily sync)**, the module will run a daily process to keep follows in sync.

### Recommendation

- Enable and configure HumHub's **queue** in your environment.
- Make sure HumHub's **cron** is configured and running periodically.

### Example (HumHub cron)

On Linux, you typically create a cron entry to execute HumHub's `cron/run`. The exact command depends on your installation, but it usually looks like:

```bash
php /path/to/humhub/protected/yii cron/run
```

This module hooks into HumHub's **daily cron** (event `EVENT_ON_DAILY_RUN`).


---

## How it works

At a high level:

1. A new user is created
2. The module loads existing **active** users
3. The new user **follows** those users

---

## Important notes

- The module targets **active** users.
- If `followAllUsers` is enabled, the daily routine may **restore follows** removed manually.

---

## FAQ

### Will the module make existing users follow everyone too?

No. The primary behavior is applied to **new users**.

### Can this slow down signup?

On instances with many users, yes. Use **cron/queue** to process in the background.

---

## Troubleshooting

- **Auto-follow is not working**
  - Make sure the module is **enabled**.
  - Confirm users are **active**.
  - If you use queue/cron, confirm the **cron is running**.

- **Signup became slow**
  - Enable asynchronous processing via **queue/cron**.

---

## Contributing

Pull requests are welcome.

Common improvement ideas:

- Add filters (by group/profile/space)
- Add an option to “follow only users with recent activity”
- Batch reprocessing routine (for migrations)

---
