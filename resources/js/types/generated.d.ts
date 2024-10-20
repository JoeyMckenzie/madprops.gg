declare namespace App.Data {
    export interface MadPropData {
        message: string;
        position: number;
        author: App.Data.UserData;
    }
    export interface UserData {
        fullName: string;
        initials: string;
        username: string;
        handle: string;
        avatar: string | null;
        jobTitle: string | null;
        companyName: string | null;
        bio: string | null;
        displaySocials: boolean;
        linkedinUsername: string | null;
        xUsername: string | null;
        githubUsername: string | null;
        pinkaryUsername: string | null;
    }
}
