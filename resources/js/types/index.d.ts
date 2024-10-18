import type { Config } from "ziggy-js";

export interface User {
    id: number;
    first_name: string;
    last_name: string;
    job_title: string;
    company_name: string;
    avatar: string;
    bio: string;
    username: string;
    email: string;
    email_verified_at?: string;
}

export type PageProps<
    T extends Record<string, unknown> = Record<string, unknown>,
> = T & {
    auth: {
        user: User;
    };
    ziggy: Config & { location: string };
};
