declare namespace App.ValueObjects {
    export interface UserProp {
        username: string;
        fullName: string;
        jobTitle: string;
        company: string;
        avatarUrl: string;
        message: string | null;
    }
}
